<?php

function xmlrpc_konora_form($args) {
   global $wpdb;
   
   $get = $args[0];
   $server = $args[1];

   $table_name = $wpdb->prefix . "konora_form";
   $rows_affected = $wpdb->insert($table_name, array(
       'ip' => $server['REMOTE_ADDR'],
       'user_agent' => $server['HTTP_USER_AGENT'],
       'language' => $server['HTTP_ACCEPT_LANGUAGE'],
       'param' => serialize($get))
   );
   
   return $rows_affected;
}

function konora_new_xmlrpc_methods($methods) {
   $methods['konora.form'] = 'xmlrpc_konora_form';
   return $methods;
}

add_filter('xmlrpc_methods', 'konora_new_xmlrpc_methods');
