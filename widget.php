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

      $title = (isset($instance['title']) and $instance['title'] != '') ? $instance['title'] : 'Newsletter';
      $text = (isset($instance['text']) and $instance['text'] != '') ? $instance['text'] : NULL;
      $btn_text = (isset($instance['button_text']) and $instance['button_text'] != '') ? $instance['button_text'] : 'Invia';
      $circle = (isset($instance['circle']) and $instance['circle'] != '') ? $instance['circle'] : NULL;
      $label = (isset($instance['label']) and $instance['label'] != '') ? checked($instance['label'], 'on') : NULL;
      $style = (isset($instance['style']) and $instance['style'] != '') ? $instance['style'] : 'widjet';
      $color = (isset($instance['color']) and $instance['color'] != '') ? $instance['color'] : NULL;
      $background = (isset($instance['background']) and $instance['background'] != '') ? $instance['background'] : NULL;
      $border_color = (isset($instance['border_color']) and $instance['border_color'] != '') ? $instance['border_color'] : NULL;
      $btn_background = (isset($instance['button_background']) and $instance['button_background'] != '') ? $instance['button_background'] : NULL;
      $btn_color = (isset($instance['button_color']) and $instance['button_color'] != '') ? $instance['button_color'] : NULL;


      include(sprintf("%s/templates/widget.php", dirname(__FILE__)));
   }

}
