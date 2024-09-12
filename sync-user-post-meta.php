<?php

/**
 * Plugin Name: Sync User Post Meta
 * Plugin URI: https://www.trainaepartners.it
 * Description: Sincronizza i meta dati tra gli utenti e i post.
 * Version: 1.0
 * Author: Marco Traina
 * Author URI: https://www.trainaepartners.it
 * License: GPLv2 or later
 * Text Domain: sync-user-post-meta
 */

// Impedisce l'accesso diretto ai file del plugin
if (!defined('ABSPATH')) {
    exit;
}

// Include file per shortcode
include(plugin_dir_path(__FILE__) . 'includes/shortcode.php');

// Include file per la gestione della pagina di amministrazione
include(plugin_dir_path(__FILE__) . 'includes/admin-page.php');

// Include il file delle funzioni
include_once(plugin_dir_path(__FILE__) . 'includes/functions.php');

