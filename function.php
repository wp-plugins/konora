<?php

function konora_do_reserved_area($atts, $content = null) {
   global $default_access_denied_text;
   global $konora;

   $current_user = wp_get_current_user();

   $url = "$konora/api/incircle?";
   $url = "http://konora.dev.local/api/circle/" . $atts['circle'] . "/inside?";

   $fields = array(
       'user' => get_option('konora_user', ''),
       'password' => get_option('konora_password', ''),
       'email' => $current_user->user_email,
       'format' => 'json'
   );

//url-ify the data for the POST
   $fields_string = '';
   foreach ($fields as $key => $value) {
      $fields_string .= $key . '=' . $value . '&';
   }

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url . $fields_string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

   $output = curl_exec($ch);

   curl_close($ch);

   if ($output != '"false"') {
      return $content;
   } else {
      return get_option('konora_access_denied_text', $default_access_denied_text);
   }
}

function konora_print_form($atts) {
   global $konora;

   $style = $atts['style'] == '' ? 'vertical' : $atts['style'];
   $btn_text = (isset($atts['button_text']) and $atts['button_text'] == '') ? $atts['button_text'] : 'Invia';
   $label = (isset($atts['label']) and ( $atts['label'] == 'on' or ! $atts['label'] == '' )) ? TRUE : FALSE;
   $background = (isset($atts['background']) and $atts['background'] != '') ? 'background-color: ' . $atts['background'] : NULL;
   $color = (isset($atts['color']) and $atts['color'] != '') ? 'color: ' . $atts['color'] : NULL;
   $border_color = (isset($atts['border_color']) and $atts['border_color'] != '') ? 'border-color: ' . $atts['border_color'] : NULL;
   $text = (isset($atts['text']) and $atts['text'] != '') ? $atts['text'] : NULL;
   $btn_background = (isset($atts['button_background']) and $atts['button_background'] != '') ? 'background-color: ' . $atts['button_background'] : NULL;
   $btn_color = (isset($atts['button_color']) and $atts['button_color'] != '') ? 'color: ' . $atts['button_color'] : NULL;
   $cirlce = $atts['circle'];
    
   $plugin_url = plugins_url(null, __FILE__);
   $css = plugins_url("css/$style.css", __FILE__);

   wp_enqueue_script('konora', plugins_url( 'js/konora.js' , __FILE__ ), array('jquery'));

   if ($atts['circle'] == "") {
      return '<span class="konora-error">error: no circle set!</span>';
   } else {
      // Render the settings template
      ob_start();
      include(sprintf("%s/templates/form.php", dirname(__FILE__)));
      return ob_get_clean();
   }
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

   file_get_contents("$konora/api/form/$konora_login_circle?name=$name&email=$email&sponsor=$sponsor&password=$password&signup=$signup");
}
