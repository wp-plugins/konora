<label for="konora_lead_template">Template: </label>

<select name="konora_lead_template">
    
    <?php foreach ($templates as $template) : ?>
      <option value="<?= $template['id']; ?>" <?= $select_template[0] == $template['id'] ? 'selected' : '' ; ?>><?= $template['name']; ?></option>
    <?php endforeach; ?>
    
</select>

<br />

<label for="konora_lead_background_image">Immagine di sfondo: </label>
<input type="text" name="konora_lead_background_image" class="image_path" value="<?php echo $img_path; ?>" id="image_path">
<input type="button" value="Upload Image" name="btn-image" class="button-primary" id="upload_image"/> Upload your Image from here.
<div id="show_upload_preview">

    <?php if (!empty($img_path)) : ?>
       <img src="<?php echo $img_path; ?>">
       <input type="submit" name="remove" value="Remove Image" class="button-secondary" id="remove_image"/>
    <?php endif; ?>
</div>