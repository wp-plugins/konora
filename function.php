<?php

function konora_do_reserved_area($atts, $content = null) {
   global $default_access_denied_text;
   global $konora;

   $current_user = wp_get_current_user();

   $url = "http://www.konora.com/api/circle/" . $atts['circle'] . "/inside?";

   $fields = array(
       'user' => get_option('konora_user', ''),
       'password' => get_option('konora_password', ''),
       'email' => $current_user->user_email,
       'format' => 'json'
   );

   $fields_string = '';
   foreach ($fields as $key => $value) {
      $fields_string .= $key . '=' . $value . '&';
   }

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url . $fields_string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_HEADER, true);

   $output = curl_exec($ch);

   curl_close($ch);

   list($header, $body) = explode("\r\n\r\n", $output, 2);

   if ($body != '"false"') {
      return $content;
   } else {
      return get_option('konora_access_denied_text', $default_access_denied_text);
   }
}

function konora_print_form($atts) {
   global $konora;

   $style = (array_key_exists('style', $atts) and $atts['style'] != '') ? $atts['style'] : 'vertical';
   $btn_text = (isset($atts['button_text']) and $atts['button_text'] != '') ? $atts['button_text'] : 'Invia';
   $label = (isset($atts['label']) and ( $atts['label'] == 'on' or ! $atts['label'] == '' )) ? TRUE : FALSE;
   $background = (isset($atts['background']) and $atts['background'] != '') ? 'background-color: ' . $atts['background'] : NULL;
   $color = (isset($atts['color']) and $atts['color'] != '') ? 'color: ' . $atts['color'] : NULL;
   $border_color = (isset($atts['border_color']) and $atts['border_color'] != '') ? 'border-color: ' . $atts['border_color'] : NULL;
   $text = (isset($atts['text']) and $atts['text'] != '') ? $atts['text'] : NULL;
   $btn_background = (isset($atts['button_background']) and $atts['button_background'] != '') ? 'background-color: ' . $atts['button_background'] : NULL;
   $btn_color = (isset($atts['button_color']) and $atts['button_color'] != '') ? 'color: ' . $atts['button_color'] : NULL;
   $inFields = (isset($atts['fields']) and $atts['fields'] != '') ? explode(';', $atts['fields']) : array('name', 'email');
   $redirect = (isset($atts['redirect']) and $atts['redirect'] != '') ? $atts['redirect'] : NULL;

   $sponsor = array_key_exists('knr', $_GET) ?
           $_GET['knr'] :
           (array_key_exists('sponsor', $_COOKIE) ? $_COOKIE['sponsor'] : get_option('admin_email') );

   if (array_key_exists('knr', $_GET)) {
      setcookie("site_sponsor", $_SERVER['HTTP_HOST'], time() + 3600 * 24 * 30, '/', '.' . second_level());
   }

   $plugin_url = plugins_url(null, __FILE__);
   $css = plugins_url("css/$style.css", __FILE__);

   if (is_array($inFields)) {
      foreach ($inFields as $key => $field) {
         $required = strstr($field, '*') ? true : false;
         $field = trim(str_replace('*', '', $field));

         $fields[$field] = $required;
      }
   }

   $fields['signup'] = (isset($atts['signup']) and $atts['signup'] != '') ? $atts['signup'] : NULL;
   $fields['pack'] = (isset($atts['pack']) and $atts['pack'] != '') ? $atts['pack'] : NULL;
   $fields['recurrence'] = (isset($atts['recurrence']) and $atts['recurrence'] != '') ? $atts['recurrence'] : NULL;

   if (!$atts['circle'] != '') {
      return '<span class="konora-error">error: no circle set!</span>';
   } else {
      $cirlce = $atts['circle'];

      // Render the settings template
      ob_start();
      include(sprintf("%s/templates/form.php", dirname(__FILE__)));
      return ob_get_clean();
   }
}

function render_meta_box_content($post) {

   wp_enqueue_script(
           '', plugins_url('js/admin.js', __FILE__), array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'), time(), true
   );

   wp_enqueue_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');

   wp_enqueue_script('media-upload'); //Provides all the functions needed to upload, validate and give format to files.
   wp_enqueue_script('thickbox'); //Responsible for managing the modal window.
   wp_enqueue_style('thickbox'); //Provides the styles needed for this window.
   wp_enqueue_script('script', plugins_url('js/upload.js', __FILE__), array('jquery'), '', true); //It will initialize the parameters needed to show the window properly.
//
   //wp_enqueue_style('jquery-ui-datepicker');
   // Add an nonce field so we can check for it later.
   wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');

   $img_path = get_post_meta($post->ID, 'konora_lead_background_image', true);
   $select_template = get_post_meta($post->ID, 'konora_lead_template', false);

   /*
    *  genera la lista dei lead nella cartella lead
    * 
    *  array = (id, name);
    */
   if ($directory_handle = opendir(plugin_dir_path(__FILE__) . 'lead/')) {
      //Scorro l'oggetto fino a quando non è termnato cioè false
      while (($file = readdir($directory_handle)) !== false) {

         if ((!is_dir($file)) & ($file != ".") & ($file != "..")) {

            list($name, $extension) = explode('.', $file);

            if (($name != "") and strpos($name, "signle-lead") === false) {

               $templates[] = substr($name, 12);
            }
         }
      }
      //Chiudo la lettura della directory.
      closedir($directory_handle);
   }

   // Render the settings template
   include(sprintf("%s/templates/meta_box.php", dirname(__FILE__)));
}

function save_meta_box($post_id) {

   /*
    * We need to verify this came from the our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */

   // Check if our nonce is set.
   if (!isset($_POST['myplugin_inner_custom_box_nonce']))
      return $post_id;

   $nonce = $_POST['myplugin_inner_custom_box_nonce'];

   // Verify that the nonce is valid.
   if (!wp_verify_nonce($nonce, 'myplugin_inner_custom_box'))
      return $post_id;

   // If this is an autosave, our form has not been submitted,
   //     so we don't want to do anything.
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      return $post_id;

   // Check the user's permissions.
   if ('page' == $_POST['post_type']) {

      if (!current_user_can('edit_page', $post_id))
         return $post_id;
   } else {

      if (!current_user_can('edit_post', $post_id))
         return $post_id;
   }

   /* OK, its safe for us to save the data now. */

   // Sanitize the user input.
   $img_path = sanitize_text_field($_POST['konora_lead_background_image']);
   $template = sanitize_text_field($_POST['konora_lead_template']);


   // Update the meta field.
   update_post_meta($post_id, 'konora_lead_background_image', $img_path);
   update_post_meta($post_id, 'konora_lead_template', $template);
}

function konora_notify_new_post($post_id) {
   global $konora;

   if (( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' )) {
      $post = get_post($post_id);
      $author = get_userdata($post->post_author);
      $author_email = $author->user_email;
      $email_subject = "Your post has been published.";

      ob_start();
      ?>

      <html>
          <head>
              <title>New post at <?php bloginfo('name') ?></title>
          </head>
          <body>
              <p>
                  Ciao {nome},
              </p>
              <p>
                  Ho appena pubblicato questo articolo:
                  <a href="<?php echo get_permalink($post->ID) ?>"><?php the_title_attribute() ?></a>.
              </p>
          </body>
      </html>

      <?php
      $message = ob_get_contents();

      ob_end_clean();

      $url = "$konora/api/newsletter2";

      $fields = array(
          'user' => get_option('konora_user', ''),
          'password' => get_option('konora_password', ''),
          'mime' => urlencode('html'),
          'testo_html' => urlencode($message),
          'fromname' => urlencode($author),
          'fromemail' => urlencode($author_email),
          'fromemail' => urlencode($author_email),
          'id_circle' => (get_option('konora_newsletter_circle', '')),
          'object' => urlencode($post->post_title)
      );

//url-ify the data for the POST
      foreach ($fields as $key => $value) {
         $fields_string .= $key . '=' . $value . '&';
      }
      rtrim($fields_string, '&');

//open connection
      $ch = curl_init();

//set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

//execute post
      $result = curl_exec($ch);

//close connection
      curl_close($ch);
   }
}

function konora_registration_form() {

//Get and set any values already sent
   $konora_sponsor = ( isset($_GET['knr']) ) ? $_GET['knr'] : '';
   ?>
   <p>
       <label for="password">E-mail Sponsor<br/>
           <input type="email" name="konora_sponsor" required id="konora_sponsor" class="input" value="<?php echo esc_attr(stripslashes($konora_sponsor)); ?>" size="25" />
       </label>
   </p>


   <p>
       <label for="password">Password<br/>
           <input id="password" class="input" required type="password" tabindex="30" size="25" value="" name="password" />
       </label>
   </p>
   <p>
       <label for="repeat_password">Ripeti password<br/>
           <input id="repeat_password" class="input"  required type="password" tabindex="40" size="25" value="" name="repeat_password" />
       </label>
   </p>


   <?php
}

function konora_registration_check($login, $email, $errors) {
   if ($_POST['password'] !== $_POST['repeat_password']) {
      $errors->add('passwords_not_matched', "<strong>ERROR</strong>: Passwords must match");
   }

   if (strlen($_POST['password']) < 8) {
      $errors->add('password_too_short', "<strong>ERROR</strong>: Passwords must be at least eight characters long");
   }
}

function konora_registration_save($user_id) {
   global $konora;

   $name = $_POST['user_login'];
   $email = $_POST['user_email'];

   /*
     $sponsor = $_POST['konora_sponsor'];
     $password = $_POST['password'];
     $konora_login_circle = get_option('konora_login_circle', '');
     $signup = get_option('konora_login_sponsor', '') ? '1' : '0';

     $userdata = array();

     $userdata['ID'] = $user_id;
     if ($password !== '') {
     $userdata['user_pass'] = $password;
     }
     $new_user_id = wp_update_user($userdata);

     update_user_meta($user_id, 'konora_password', $password);
     update_user_meta($user_id, 'konora_email', $email);
    */

   file_get_contents("$konora/api/form/$konora_login_circle?name=$name&email=$email");
}

function cookie_domain() {
   // I cookie dello sponsor operano sul dominio di terzo livello
   return NULL;

   // I cookie dello sponsor operano sul dominio di secondo livello
   // return '.' . second_level() ;
}

if (!function_exists('second_level')) {

   function second_level() {
      $purl = parse_url("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");

      $secondolivello = isset($purl['host']) ? $purl['host'] : '';

      if (preg_match('/(?P<secliv>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $secondolivello, $regs)) {
         return $regs['secliv'];
      } else {
         return false;
      }
   }

}

function get_browsername($user_agent) {
   $browser = "Unknown Browser";

   $browser_array = array(
       '/msie/i' => 'Internet Explorer',
       '/firefox/i' => 'Firefox',
       '/safari/i' => 'Safari',
       '/chrome/i' => 'Chrome',
       '/opera/i' => 'Opera',
       '/netscape/i' => 'Netscape',
       '/maxthon/i' => 'Maxthon',
       '/konqueror/i' => 'Konqueror',
       '/mobile/i' => 'Handheld Browser'
   );

   foreach ($browser_array as $regex => $value) {

      if (preg_match($regex, $user_agent)) {
         $browser = $value;
      }
   }

   return $browser;
}

function getOS($user_agent) {

   $os_platform = "Unknown OS Platform";

   $os_array = array(
       '/windows nt 10/i' => 'Windows 10',
       '/windows nt 6.3/i' => 'Windows 8.1',
       '/windows nt 6.2/i' => 'Windows 8',
       '/windows nt 6.1/i' => 'Windows 7',
       '/windows nt 6.0/i' => 'Windows Vista',
       '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
       '/windows nt 5.1/i' => 'Windows XP',
       '/windows xp/i' => 'Windows XP',
       '/windows nt 5.0/i' => 'Windows 2000',
       '/windows me/i' => 'Windows ME',
       '/win98/i' => 'Windows 98',
       '/win95/i' => 'Windows 95',
       '/win16/i' => 'Windows 3.11',
       '/macintosh|mac os x/i' => 'Mac OS X',
       '/mac_powerpc/i' => 'Mac OS 9',
       '/linux/i' => 'Linux',
       '/ubuntu/i' => 'Ubuntu',
       '/iphone/i' => 'iPhone',
       '/ipod/i' => 'iPod',
       '/ipad/i' => 'iPad',
       '/android/i' => 'Android',
       '/blackberry/i' => 'BlackBerry',
       '/webos/i' => 'Mobile'
   );

   foreach ($os_array as $regex => $value) {

      if (preg_match($regex, $user_agent)) {
         $os_platform = $value;
      }
   }

   return $os_platform;
}
