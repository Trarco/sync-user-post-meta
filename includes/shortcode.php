<?php

// Funzione per sincronizzare user_meta con post_meta
function sync_user_post_meta_shortcode($atts)
{
    global $post;

    // Estrai gli attributi dello shortcode e imposta i valori predefiniti
    $atts = shortcode_atts(
        array(
            'source' => 'user',  // Indica se il dato viene sincronizzato da utente o post
            'meta' => '',        // Nome del campo meta da sincronizzare
        ),
        $atts,
        'sync_user_post_meta'
    );

    // Verifica che 'meta' non sia vuoto
    if (empty($atts['meta'])) {
        return '<div class="alert alert-error">Errore: Devi specificare il nome del meta.</div>';
    }

    // Verifica che ci sia un post disponibile
    if (!$post) {
        return '<div class="alert alert-error">Errore: Nessun post disponibile.</div>';
    }

    // Ottieni l'ID dell'autore del post e l'ID del post
    $author_id = $post->post_author;
    $post_id = $post->ID;

    // Ottieni il nome del campo meta da sincronizzare
    $meta_name = $atts['meta'];

    // Se la sorgente è 'user', sincronizza da user_meta a post_meta
    if ($atts['source'] === 'user') {
        $user_meta_value = get_user_meta($author_id, $meta_name, true);  // Ottieni il valore del meta utente
        if (!empty($user_meta_value)) {
            update_post_meta($post_id, $meta_name, $user_meta_value);  // Aggiorna il meta del post con il valore utente
            return "<div class='alert alert-success'>Meta \"{$meta_name}\" sincronizzato da utente a post.</div>";
        } else {
            return "<div class='alert alert-error'>Il meta utente \"{$meta_name}\" non esiste o è vuoto.</div>";
        }
    }
    // Se la sorgente è 'post', sincronizza da post_meta a user_meta
    elseif ($atts['source'] === 'post') {
        $post_meta_value = get_post_meta($post_id, $meta_name, true);  // Ottieni il valore del meta post
        if (!empty($post_meta_value)) {
            update_user_meta($author_id, $meta_name, $post_meta_value);  // Aggiorna il meta utente con il valore del post
            return "<div class='alert alert-success'>Meta \"{$meta_name}\" sincronizzato da post a utente.</div>";
        } else {
            return "<div class='alert alert-error'>Il meta post \"{$meta_name}\" non esiste o è vuoto.</div>";
        }
    }

    // Se la sorgente non è valida
    return "<div class='alert alert-error'>Errore: Sorgente non valida. Usa \"user\" o \"post\".</div>";
}

// Registra lo shortcode [sync_user_post_meta source="user" meta="nome_del_meta"]
function register_sync_user_post_meta_shortcode()
{
    add_shortcode('sync_user_post_meta', 'sync_user_post_meta_shortcode');
}
add_action('init', 'register_sync_user_post_meta_shortcode');
