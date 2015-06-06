<?php

function konora_option_help() {
   ?>

   <h2>Documentazione</h2>

   <p>
      <a href="<?= plugins_url( 'doc/Konora_Plugin_WordPress.pdf' , __FILE__ ); ?>" target="_blank">
         Scarica il pdf con la documentazione di questo plugin.
      </a>
   </p>
   <?php
}

function konora_option_api() {
   if (isset($_POST['konora-save'])) {

      if (isset($_POST['konora_user'])) {
         update_option('konora_user', $_POST['konora_user']);
      }

      if (isset($_POST['konora_password'])) {
         update_option('konora_password', $_POST['konora_password']);
      }
   }

   $javascript = plugins_url('js/options.js', __FILE__);
   ?>

   <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
   <script language="javascript" type="text/javascript" src="<?= $javascript; ?>"></script>

   <h2>Opzioni del plugin di Konora</h2>
   <form method="POST">

      <h3>Parametri di accesso a Konora</h3>

      <p>
         Alcune delle funzioni le puoi utilizzare solo se inserisci i parametri di
         accesso di Konora
      </p>

      <p>
         E-Mail: <input type="text"  name="konora_user" value="<?= get_option('konora_user', ''); ?>">
         Password: <input type="password"  name="konora_password" value="<?= get_option('konora_password', ''); ?>">
      </p>

      <h3>Nuovo utente</h3>

      <p>
         Se non disponi di un account Konora 
         <a href="https://www.konora.com/register/MjY5" class="button-secondary">creare un nuovo account</a>
      </p>

      <p class="submit">
         <input type="submit" name="konora-save" class="button button-primary" value="Save le opzioni">
      </p>

   </form>
   <?php
}

function konora_option_login() {
   if (isset($_POST['konora-save'])) {
      if (isset($_POST['konora_login'])) {
         update_option('konora_login', $_POST['konora_login']);
      } else {
         update_option('konora_login', 'off');
      }

      if (isset($_POST['konora_login_sponsor'])) {
         update_option('konora_login_sponsor', $_POST['konora_login_sponsor']);
      } else {
         update_option('konora_login_sponsor', 'off');
      }

      if (isset($_POST['konora_login_circle']))
         update_option('konora_login_circle', $_POST['konora_login_circle']);
   }
   $javascript = plugins_url('js/options.js', __FILE__);
   ?>

   <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
   <script language="javascript" type="text/javascript" src="<?= $javascript; ?>"></script>

   <h2>Opzioni del plugin di Konora</h2>
   <form method="POST">

      <h3>Sincronizza gli utenti con Konora</h3>

      <p>
         <input type="checkbox"  name="konora_login" id="konora_login" <?= get_option('konora_login', '') == 'on' ? 'checked' : '' ?>>
         Abilitando questa opzione &egrave; possibile registrare su Konora
         tutti gli utenti che si registrano su WordPress.
      </p>

      <p>
         Aggiungi i nuovi registrati in questo circolo: 
         <input type="text"  name="konora_login_circle" id="konora_login_circle" value="<?= get_option('konora_login_circle', ''); ?>">
      </p> 

      <p class="submit">
         <input type="submit" name="konora-save" class="button button-primary" value="Save le opzioni">
      </p>

   </form>
   <?php
}

function konora_option_newsletter() {
   if (isset($_POST['konora-save'])) {

      if (isset($_POST['konora_publish_post'])) {
         update_option('konora_publish_post', $_POST['konora_publish_post']);
      } else {
         update_option('konora_publish_post', 'off');
      }

      if (isset($_POST['konora_newsletter_circle']))
         update_option('konora_newsletter_circle', $_POST['konora_newsletter_circle']);
   }
   $javascript = plugins_url('js/options.js', __FILE__);
   ?>

   <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
   <script language="javascript" type="text/javascript" src="<?= $javascript; ?>"></script>

   <h2>Opzioni del plugin di Konora</h2>
   <form method="POST">

      <h3>Invia una Newsletter quando pubblichi un nuovo post</h3>

      <p>
         <b>Per attivare questa voce &egrave; necessario avere inserito le credenziali 
            per accedere alle API
         </b>
      </p>
      <p>
         <input type="checkbox"  name="konora_publish_post" <?= get_option('konora_publish_post', '') == 'on' ? 'checked' : '' ?>>
         Abilitando questa opzione verr&agrave; inviata una newsletter ogni volta che viene
         pubblicato un nuovo articolo.
      </p> 

      <p>
         Invia la newsletter a questo circolo: <input type="text"  name="konora_newsletter_circle" value="<?= get_option('konora_newsletter_circle', ''); ?>">
      </p> 

      <p class="submit">
         <input type="submit" name="konora-save" class="button button-primary" value="Save le opzioni">
      </p>

   </form>
   <?php
}

function konora_option_reserved_area() {
   global $default_access_denied_text;
   
   if (isset($_POST['konora-save'])) {
      if (isset($_POST['konora_reserved_area'])) {
         update_option('konora_reserved_area', $_POST['konora_reserved_area']);
      } else {
         update_option('konora_reserved_area', 'off');
      }
      
      if (isset($_POST['konora_access_denied_text']))
         update_option('konora_access_denied_text', stripslashes($_POST['konora_access_denied_text']));
   }
   
   $javascript = plugins_url('js/options.js', __FILE__);

   ?>

   <h2>Area Riservata</h2>

   <p>
      Questa opzione ti permette di abilitare alla visione di alcuni contenuti 
      solo alcuni utenti. Per poter funzionare devi dare agli utenti la 
      possibilit&agrave; di registrarsi a WordPress. 
   </p>

   <p>
      All'interno della pagina di modifica dell'articolo, o della pagina, puoi 
      impostare a quale circolo l'utente deve appartenere per poter vedere il
      contenuto.
   </p>

   <form method="POST">
   <p>
      <input type="checkbox"  name="konora_reserved_area" id="konora_login" <?= get_option('konora_reserved_area', '') == 'on' ? 'checked' : '' ?>>
      Abilita la gestione dell'area riservata
   </p> 

   <p>
      Inserisci il messaggio da visualizzare in caso manchano i permessi.
   </p>
   
   <p>
      <?php wp_editor( get_option('konora_access_denied_text', $default_access_denied_text), 'konora_access_denied_text' ); ?>
   </p>
   
   <p class="submit">
      <input type="submit" name="konora-save" class="button button-primary" value="Save le opzioni">
   </p>
   </form>
   <?php
}

function konora_option_leads_page() {
   global $default_access_denied_text;

   if (isset($_POST['konora-save'])) {
      if (isset($_POST['konora_leads_page'])) {
         update_option('konora_leads_page', $_POST['konora_leads_page']);
      } else {
         update_option('konora_leads_page', 'off');
      }
   }

   $javascript = plugins_url('js/options.js', __FILE__);

   ?>

   <h2>Leads Page</h2>

   <p>
      Queste pagine servono per creare, in pochi secondi, delle landing page che possono
      essere usate per inserire i moduli di raccolta dei dati.
   </p>

   <form method="POST">
   <p>
      <input type="checkbox"  name="konora_leads_page" id="konora_leads_page" <?= get_option('konora_leads_page', '') == 'on' ? 'checked' : '' ?>>
      Abilita le pagine di tipo leads
   </p>

   <p class="submit">
      <input type="submit" name="konora-save" class="button button-primary" value="Save le opzioni">
   </p>
   </form>
   <?php
}
