<script type='text/javascript'>
   jQuery(document).ready(function ($) {
       $('.my-color-picker').wpColorPicker();
   });
</script>

<p>
    <label for="<?php echo $this->get_field_id("title"); ?>">Titolo: </label>
    <input type="text"  value="<?= $title ?>" name="<?= $this->get_field_name("title"); ?>" id="<?= $this->get_field_id("title") ?>" class="widefat" />
</p>
<p>
    <label for="<?php echo $this->get_field_id("text"); ?>">Testo: </label>
    <textarea rows="4" name="<?= $this->get_field_name("text"); ?>" id="<?= $this->get_field_id("text") ?>" class="widefat"><?= $text; ?></textarea>
</p>
<p>
    <label for="<?php echo $this->get_field_id("button_text"); ?>">Testo del bottone di invio: </label>
    <input type="text"  value="<?= $btn_text; ?>" name="<?= $this->get_field_name("button_text"); ?>" id="<?= $this->get_field_id("button_text") ?>" class="widefat" />
</p>
<p>
    <label for="<?php echo $this->get_field_id("circle"); ?>">Codice Del Circolo: </label>
    <input type="text"  value="<?= $circle; ?>" name="<?= $this->get_field_name("circle"); ?>" id="<?= $this->get_field_id("circle") ?>">
</p>
<p>
    <input class="checkbox" type="checkbox" <?= $label; ?> id="<?php echo $this->get_field_id('label'); ?>" name="<?php echo $this->get_field_name('label'); ?>" /> 
    <label for="<?php echo $this->get_field_id('label'); ?>">Visualizza le etichette</label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("style"); ?>">Foglio di stile:</label>
    <input type="text"  value="<?= $style; ?>" name="<?= $this->get_field_name("style"); ?>" id="<?= $this->get_field_id("style") ?>" class="widefat" />
</p>
<p>
    <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" value="<?= $background; ?>" />
    <label for="<?php echo $this->get_field_id('background'); ?>">Colore di sfondo</label>
</p>
<p>
    <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" value="<?= $border_color; ?>" />
    <label for="<?php echo $this->get_field_id('border_color'); ?>">Colore del bordo</label>
</p>
<p>
    <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?= $color; ?>" />
    <label for="<?php echo $this->get_field_id('color'); ?>">Colore dello testo</label>
</p>
<p>
    <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('button_background'); ?>" name="<?php echo $this->get_field_name('button_background'); ?>" value="<?= $btn_background; ?>" />
    <label for="<?php echo $this->get_field_id('button_background'); ?>">Colore di sfondo del bottone</label>
</p>
<p>
    <input type="text" class="my-color-picker" id="<?php echo $this->get_field_id('button_color'); ?>" name="<?php echo $this->get_field_name('button_color'); ?>" value="<?= $btn_color; ?>" />
    <label for="<?php echo $this->get_field_id('button_color'); ?>">Colore dello testo del bottone</label>
</p>