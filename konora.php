<?php

/**
 * Plugin Name: Form Raccogli Dati Konora
 * Plugin URI: http://blog.konora.com/plugin/
 * Description: Converti le visite al tuo sito in contatti per il tuo buisness
 * Version: 0.4
 * Author: Konora ltd
 * Author URI: http://www.konora.com
 * License: GPLv2 or later
 */

include_once plugin_dir_path(__FILE__) . 'function.php';
include_once plugin_dir_path(__FILE__) . 'widget.php';
include_once plugin_dir_path(__FILE__) . 'options.php';

$konora = 'http://konora.dev.local';
$default_access_denied_text = "<p>Non hai i permessi per visualizzare questo contenuto!</p>";

define('KONORA_ICON', plugins_url('image/konora.ico', __FILE__));

$plugin = plugin_basename(__FILE__);

register_activation_hook(__FILE__, 'konora_install');
register_deactivation_hook(__FILE__, 'konora_uninstall');

add_shortcode('konora', 'konora_print_form');

add_action('admin_menu', 'konora_add_page');
add_action('widgets_init', 'konora_widgets');

add_filter("plugin_action_links_$plugin", 'konora_settings_link');

if (get_option('konora_login', '') == 'on' and get_option('konora_login_circle', '') != '') {
   add_action('register_form', 'konora_registration_form');
   add_action('register_post', 'konora_registration_check', 10, 3);
   add_action('user_register', 'konora_registration_save', 100);
}

if (get_option('konora_reserved_area', '') == 'on') {
   add_shortcode('reserved', 'konora_do_reserved_area');
}

if (get_option('konora_publish_post', '') == 'on' and get_option('konora_newsletter_circle', '') != '') {
   add_action('publish_post', 'konora_notify_new_post');
}

function konora_add_page() {
   add_menu_page('Opzioni di Konora', 'Konora', 'manage_options', 'konora_options', 'konora_option_help', KONORA_ICON);
   add_submenu_page('konora_options', 'Page title', 'Autenticazione API', 'manage_options', 'konora_option_api', 'konora_option_api');
   add_submenu_page('konora_options', 'Page title', 'Sincronizza Login', 'manage_options', 'konora_option_login', 'konora_option_login');
   add_submenu_page('konora_options', 'Page title', 'Newsletter', 'manage_options', 'konora_option_newsletter', 'konora_option_newsletter');
   add_submenu_page('konora_options', 'Page title', 'Area Riservata', 'manage_options', 'konora_option_reserved_area', 'konora_option_reserved_area');
}

function konora_settings_link($links) {
   $settings_link = '<a href="?page=konora_options">Impostazioni</a>';
   array_unshift($links, $settings_link);
   return $links;
}

function konora_widgets() {
   wp_enqueue_style( 'wp-color-picker' );        
	wp_enqueue_script( 'wp-color-picker' );
   
   register_widget('konoraWidget');
}

function konora_install() {
   
}

function konora_uninstall() {
   
}

