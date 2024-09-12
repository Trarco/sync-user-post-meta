<?php
// Aggiungi una voce di menu alla dashboard di WordPress
function sync_user_post_meta_menu()
{
    add_menu_page(
        'Sync User Post Meta',   // Titolo della pagina
        'Sync Meta',             // Nome nel menu
        'manage_options',        // Capacità richiesta
        'sync-user-post-meta',   // Slug del menu
        'sync_user_post_meta_page', // Funzione di callback
        'dashicons-update',      // Icona del menu
        100                      // Posizione nel menu
    );
}
add_action('admin_menu', 'sync_user_post_meta_menu');

// Funzione di callback per la pagina di amministrazione
function sync_user_post_meta_page()
{
    // Recupera tutti gli utenti
    $users = get_users(array('fields' => array('ID', 'display_name')));

    // Crea un array associativo per l'input select degli utenti
    $user_options = array();
    foreach ($users as $user) {
        $user_options[$user->ID] = $user->display_name;
    }

    // Recupera i meta key disponibili per l'utente selezionato se esiste
    $selected_user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $meta_keys = $selected_user_id ? get_user_meta_keys($selected_user_id) : array();

    // Recupera il meta key selezionato
    $selected_meta_key = isset($_POST['meta_key']) ? sanitize_text_field($_POST['meta_key']) : '';

    // Recupera i post type disponibili
    $post_types = get_post_types(array('public' => true), 'objects');

?>
    <div class="wrap">
        <h1>Sincronizza i Meta Dati</h1>
        <form method="post" action="">
            <?php
            // Aggiungi un campo nonce per la sicurezza
            wp_nonce_field('sync_user_post_meta_nonce', 'sync_user_post_meta_nonce_field');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Seleziona Utente</th>
                    <td>
                        <select name="user_id" id="user_id" required>
                            <option value="">Seleziona un utente</option>
                            <?php
                            foreach ($user_options as $id => $name) {
                                echo "<option value='" . esc_attr($id) . "'" . selected($selected_user_id, $id, false) . ">" . esc_html($name) . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top" id="meta-key-row" style="display: <?php echo $selected_user_id ? 'table-row' : 'none'; ?>;">
                    <th scope="row">Seleziona Meta Key</th>
                    <td>
                        <select name="meta_key" id="meta_key" required>
                            <option value="">Seleziona un meta key</option>
                            <?php
                            foreach ($meta_keys as $meta_key) {
                                echo "<option value='" . esc_attr($meta_key) . "'" . selected($selected_meta_key, $meta_key, false) . ">" . esc_html($meta_key) . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top" id="post-type-row" style="display: <?php echo $selected_user_id && $selected_meta_key ? 'table-row' : 'none'; ?>;">
                    <th scope="row">Seleziona Post Types</th>
                    <td>
                        <?php
                        foreach ($post_types as $post_type) {
                            $checked = isset($_POST['post_types']) && in_array($post_type->name, $_POST['post_types']) ? 'checked' : '';
                            echo "<label><input type='checkbox' name='post_types[]' value='" . esc_attr($post_type->name) . "' $checked> " . esc_html($post_type->labels->singular_name) . "</label><br>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <?php submit_button('Sincronizza i post con il Meta Dato utente'); ?>
        </form>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var userSelect = document.getElementById('user_id');
            var metaKeyRow = document.getElementById('meta-key-row');
            var postTypeRow = document.getElementById('post-type-row');
            var nonce = '<?php echo wp_create_nonce('sync_user_post_meta_nonce'); ?>'; // Genera il nonce

            userSelect.addEventListener('change', function() {
                if (this.value) {
                    metaKeyRow.style.display = 'table-row';
                    postTypeRow.style.display = 'table-row';
                    var userId = this.value;
                    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_meta_keys&user_id=' + userId + '&nonce=' + nonce)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                var metaKeySelect = document.getElementById('meta_key');
                                metaKeySelect.innerHTML = '<option value="">Seleziona un meta key</option>';
                                data.data.forEach(function(metaKey) {
                                    var option = document.createElement('option');
                                    option.value = metaKey;
                                    option.textContent = metaKey;
                                    metaKeySelect.appendChild(option);
                                });
                            } else {
                                console.error('Errore nella risposta AJAX: ', data.data);
                            }
                        })
                        .catch(error => console.error('Errore nella richiesta AJAX: ', error));
                } else {
                    metaKeyRow.style.display = 'none';
                    postTypeRow.style.display = 'none';
                }
            });
        });
    </script>

<?php
    // Verifica se il form è stato inviato
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verifica il nonce per la sicurezza
        if (isset($_POST['sync_user_post_meta_nonce_field']) && wp_verify_nonce($_POST['sync_user_post_meta_nonce_field'], 'sync_user_post_meta_nonce')) {
            // Recupera l'ID dell'utente, il meta key selezionato e i post types
            $user_id = intval($_POST['user_id']);
            $meta_key = sanitize_text_field($_POST['meta_key']);
            $post_types = isset($_POST['post_types']) ? array_map('sanitize_text_field', $_POST['post_types']) : array();

            // Verifica che l'ID, il meta key e i post types siano validi
            if ($user_id > 0 && !empty($meta_key) && !empty($post_types)) {
                // Chiama la funzione per sincronizzare tutti i post
                manual_sync_all_posts($user_id, $meta_key, $post_types);

                // Messaggio di successo
                echo '<div class="notice notice-success is-dismissible"><p>Sincronizzazione completata con successo per l\'utente con ID ' . $user_id . ' e meta key ' . esc_html($meta_key) . '.</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Errore: Seleziona un utente, un meta key valido e almeno un tipo di post.</p></div>';
            }
        }
    }
}

// Funzione per ottenere i meta keys tramite AJAX
function ajax_get_meta_keys()
{
    // Verifica il nonce per la sicurezza
    if (! isset($_GET['user_id']) || ! check_ajax_referer('sync_user_post_meta_nonce', 'nonce', false)) {
        wp_send_json_error('Nonce di sicurezza non valido');
        return;
    }

    $user_id = intval($_GET['user_id']);
    if ($user_id > 0) {
        $meta_keys = get_user_meta_keys($user_id);
        wp_send_json_success($meta_keys);
    } else {
        wp_send_json_error('ID utente non valido');
    }
}
add_action('wp_ajax_get_meta_keys', 'ajax_get_meta_keys');
