<?php

/**
 * Plugin Name: Form Raccogli Dati Konora
 * Plugin URI: http://blog.konora.com/plugin/
 * Description: Converti le visite al tuo sito in contatti per il tuo buisness
 * Version: 0.9.3
 * Author: Konora ltd
 * Author URI: http://www.konora.com
 * License: GPLv2 or later
 */

include_once plugin_dir_path(__FILE__) . 'function.php';
include_once plugin_dir_path(__FILE__) . 'admin.php';
include_once plugin_dir_path(__FILE__) . 'widget.php';
include_once plugin_dir_path(__FILE__) . 'options.php';
include_once plugin_dir_path(__FILE__) . 'xmlrpc.php';

$konora                     = 'http://panel.konora.com';
$default_access_denied_text = "<p>Non hai i permessi per visualizzare questo contenuto!</p>";

define('KONORA_ICON', plugins_url('image/konora.ico', __FILE__));

$plugin = plugin_basename(__FILE__);

register_activation_hook(__FILE__, 'konora_install');
register_deactivation_hook(__FILE__, 'konora_uninstall');

add_action('plugins_loaded', 'konora_update_db_check');

add_shortcode('konora', 'konora_print_form');

add_action('init', 'konora_init');
add_action('admin_menu', 'konora_add_page');
add_action('admin_init', 'konora_admin_init');
add_action('wp_login', 'konora_admin_init');
add_action('widgets_init', 'konora_widgets');

add_filter("plugin_action_links_$plugin", 'konora_settings_link');
add_filter('single_template', 'get_custom_post_type_template');


if (get_option('konora_login', '') == 'on' and get_option('konora_login_circle', '') != '') {
    //add_action('register_form', 'konora_registration_form');
    //add_action('register_post', 'konora_registration_check', 10, 3);
    add_action('user_register', 'konora_registration_save', 100);
}

if (get_option('konora_reserved_area', '') == 'on') {
    add_shortcode('reserved', 'konora_do_reserved_area');
}

if (get_option('konora_publish_post', '') == 'on' and get_option('konora_newsletter_circle', '') != '') {
    add_action('publish_post', 'konora_notify_new_post');
}

if (get_option('konora_leads_page', '') != 'off') {
    add_action('add_meta_boxes', 'konora_add_meta_box');
    add_action('save_post', 'save_meta_box');
}

function konora_init()
{
    if (array_key_exists('knr', $_GET) and ($_GET['knr'] != '')) {
        
        setcookie("sponsor", $_GET['knr'], time() + 3600 * 24 * 30, '/', '.' . second_level());
    }
    
    if (!array_key_exists('sponsor', $_COOKIE)) {
        
        setcookie("sponsor", get_option('admin_email'), time() + 3600 * 24 * 30, '/', '.' . second_level());
    }
    
    if (get_option('konora_leads_page', '') != 'off') {
        
        register_post_type('lead', array(
            'labels' => array(
                'name' => 'Konora Leads',
                /* Nome, al plurale, dell'etichetta del post type. */
                'singular_name' => 'Lead',
                /* Nome, al singolare, dell'etichetta del post type. */
                'all_items' => 'Tutti i Leads',
                /* Testo mostrato nei menu che indica tutti i contenuti del post type */
                'add_new' => 'Aggiungi nuovo',
                /* Il testo per il pulsante Aggiungi. */
                'add_new_item' => 'Aggiungi nuovo Lead',
                /* Testo per il pulsante Aggiungi nuovo post type */
                'edit_item' => 'Modifica Lead',
                /*  Testo per modifica */
                'new_item' => 'Nuovo Lead',
                /* Testo per nuovo oggetto */
                'view_item' => 'Visualizza Lead',
                /* Testo per visualizzare */
                'search_items' => 'Cerca Lead',
                /* Testo per la ricerca */
                'not_found' => 'Nessun Lead trovato',
                /* Testo per risultato non trovato */
                'not_found_in_trash' => 'Nessun Lead trovato nel cestino',
                /* Testo per risultato non trovato nel cestino */
                'parent_item_colon' => ''
            ),
            /* Fine dell'array delle etichette */
            'description' => 'Raccolta di Lead del portale',
            /* Una breve descrizione del post type */
            'public' => true,
            /* Definisce se il post type sia visibile sia da front-end che da back-end */
            'publicly_queryable' => true,
            /* Definisce se possono essere fatte query da front-end */
            'exclude_from_search' => false,
            /* Definisce se questo post type è escluso dai risultati di ricerca */
            'show_ui' => true,
            /* Definisce se deve essere visualizzata l'interfaccia di default nel pannello di amministrazione */
            'query_var' => true,
            'menu_position' => 8,
            /* Definisce l'ordine in cui comparire nel menù di amministrazione a sinistra */
            'menu_icon' => KONORA_ICON,
            /* Scegli l'icona da usare nel menù per il posty type */
            'rewrite' => array(
                'slug' => 'lead',
                'with_front' => false
            ),
            /* Puoi specificare uno slug per gli URL */
            'has_archive' => 'true',
            /* Definisci se abilitare la generazione di un archivio (equivalente di archive-libri.php) */
            'capability_type' => 'post',
            /* Definisci se si comporterà come un post o come una pagina */
            'hierarchical' => false,
            /* Definisci se potranno essere definiti elementi padri di altri */
            /* la riga successiva definisce quali elementi verranno visualizzati nella schermata di creazione del post */
            //'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
            'supports' => array(
                'title',
                'editor',
                'sticky',
                'author'
            )
        ));
    }
    
    flush_rewrite_rules();
}

function konora_add_meta_box($post_type)
{
    add_meta_box('some_meta_box_name', 'Opzioni', 'render_meta_box_content', $post_type, 'advanced', 'high');
}

function get_custom_post_type_template($single_template)
{
    global $post;
    
    if ($post->post_type == 'lead') {
        
        if (have_posts()):
            while (have_posts()):
                the_post();
                $template        = get_post_meta(get_the_ID(), 'konora_lead_template', 1);
                $single_template = dirname(__FILE__) . '/lead/single-lead_' . $template[0] . '.php';
            endwhile;
        endif;
    }
    
    return $single_template;
}

function konora_add_page()
{
    add_menu_page('Opzioni di Konora', 'Konora', 'manage_options', 'konora_options', 'konora_option_help', KONORA_ICON);
    add_submenu_page('konora_options', 'Page title', 'Autenticazione API', 'manage_options', 'konora_option_api', 'konora_option_api');
    add_submenu_page('konora_options', 'Page title', 'Sincronizza Login', 'manage_options', 'konora_option_login', 'konora_option_login');
    add_submenu_page('konora_options', 'Page title', 'Newsletter', 'manage_options', 'konora_option_newsletter', 'konora_option_newsletter');
    add_submenu_page('konora_options', 'Page title', 'Area Riservata', 'manage_options', 'konora_option_reserved_area', 'konora_option_reserved_area');
    add_submenu_page('konora_options', 'Page title', 'Leads Page', 'manage_options', 'konora_option_leads_page', 'konora_option_leads_page');
}

function konora_settings_link($links)
{
    $settings_link = '<a href="?page=konora_options">Impostazioni</a>';
    array_unshift($links, $settings_link);
    return $links;
}

function konora_widgets()
{
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    
    register_widget('konoraWidget');
}

function konora_db_install()
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . "konora_form";
    
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
              `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `ip` varchar(15) NOT NULL,
              `user_agent` varchar(300) DEFAULT NULL,
              `language` varchar(150) DEFAULT NULL,
              `param` text NOT NULL
            );";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    add_option('konora_db_version', '0.1');
}

function konora_update_db_check()
{
    if (get_option('konora_db_version', NULL) != '0.1') {
        konora_db_install();
    }
}

function konora_install()
{
    
}

function konora_uninstall()
{
    
}
