<?php

class konoraWidget extends WP_Widget {

   function konoraWidget() {
      parent::__construct(false, 'Konora Widget');
   }

   function widget($args, $instance) {
      extract($args);

      $title = isset($instance['title']) ? $instance['title'] : 'Newsletter';

      echo $before_widget;
      echo $before_title . $title . $after_title;

      //DA QUI INIZIA IL WIDGET VERO E PROPRIO
      echo konora_print_form($instance);
      //FINE WIDGET

      echo $after_widget;
   }

   function update($new_instance, $old_instance) {
      $instance = $old_instance;
      //ADD THIS
      $instance['your_checkbox_var'] = $new_instance['your_checkbox_var'];

      return $new_instance;
   }

   function myWidget() {
      
   }

   function form($instance) {
      wp_enqueue_style('wp-color-picker');
      ?>
      <script type='text/javascript'>
         jQuery(document).ready(function($) {
            $('.my-color-picker').wpColorPicker();
         });
      </script>

      <p>
         <label for="<?php echo $this->get_field_id("title"); ?>">Titolo: </label>
         <input type="text"  value="<?= $instance['title'] != '' ? $instance['title'] : 'Newsletter'; ?>" name="<?= $this->get_field_name("title"); ?>" id="<?= $this->get_field_id("title") ?>" class="widefat" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id("text"); ?>">Testo: </label>
         <textarea rows="4" name="<?= $this->get_field_name("text"); ?>" id="<?= $this->get_field_id("text") ?>" class="widefat"><?= $instance['text']; ?></textarea>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id("button_text"); ?>">Testo del bottone di invio: </label>
         <input type="text"  value="<?= $instance['button_text'] != '' ? $instance['button_text'] : 'Invia'; ?>" name="<?= $this->get_field_name("button_text"); ?>" id="<?= $this->get_field_id("button_text") ?>" class="widefat" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id("circle"); ?>">Codice Del Circolo: </label>
         <input type="text"  value="<?= $instance['circle']; ?>" name="<?= $this->get_field_name("circle"); ?>" id="<?= $this->get_field_id("circle") ?>">
      </p>
      <p>
         <input class="checkbox" type="checkbox" <?php checked($instance['label'], 'on'); ?> id="<?php echo $this->get_field_id('label'); ?>" name="<?php echo $this->get_field_name('label'); ?>" /> 
         <label for="<?php echo $this->get_field_id('label'); ?>">Visualizza le etichete</label>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id("style"); ?>">Foglio di stile:</label>
         <input type="text"  value="<?= $instance['style'] == '' ? 'widjet' : $instance['style']; ?>" name="<?= $this->get_field_name("style"); ?>" id="<?= $this->get_field_id("style") ?>" class="widefat" >
      </p>
      <p>
         <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" value="<?= $instance['background']; ?>" />
         <label for="<?php echo $this->get_field_id('background'); ?>">Colore di sfondo</label>
      </p>
      <p>
         <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" value="<?= $instance['border_color']; ?>" />
         <label for="<?php echo $this->get_field_id('border_color'); ?>">Colore del bordo</label>
      </p>
      <p>
         <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?= $instance['color']; ?>" />
         <label for="<?php echo $this->get_field_id('color'); ?>">Colore dello testo</label>
      </p>
      <p>
         <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('button_background'); ?>" name="<?php echo $this->get_field_name('button_background'); ?>" value="<?= $instance['button_background']; ?>" />
         <label for="<?php echo $this->get_field_id('button_background'); ?>">Colore di sfondo del bottone</label>
      </p>
      <p>
         <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('button_color'); ?>" name="<?php echo $this->get_field_name('button_color'); ?>" value="<?= $instance['button_color']; ?>" />
         <label for="<?php echo $this->get_field_id('button_color'); ?>">Colore dello testo del bottone</label>
      </p>
      <?php
   }

}
