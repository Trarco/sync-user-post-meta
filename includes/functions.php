<?php

/**
 * Ottiene tutte le chiavi dei meta dati per un utente.
 *
 * @param int $user_id ID dell'utente.
 * @return array Lista dei meta key.
 */
function get_user_meta_keys($user_id)
{
    $meta_keys = array();
    $user_meta = get_user_meta($user_id);
    foreach ($user_meta as $key => $value) {
        $meta_keys[] = $key;
    }
    return $meta_keys;
}

/**
 * Sincronizza i meta dati degli utenti con i post.
 *
 * @param int $user_id ID dell'utente.
 * @param string $meta_key Meta key da sincronizzare.
 * @param array $post_types Tipi di post da sincronizzare.
 */
function manual_sync_all_posts($user_id, $meta_key, $post_types)
{
    $user_meta_value = get_user_meta($user_id, $meta_key, true);

    foreach ($post_types as $post_type) {
        $user_posts = get_posts(array(
            'author' => $user_id,
            'post_type' => $post_type,
            'numberposts' => -1,
        ));

        foreach ($user_posts as $post) {
            update_post_meta($post->ID, $meta_key, $user_meta_value);
        }
    }
}
