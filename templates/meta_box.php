<label for="konora_lead_template">Template: </label>
<select name="konora_lead_template">
    <option value="1" <?= $template[0] == 1 ? 'selected' : '' ; ?>>Vuoto</option>
    <option value="2" <?= $template[0] == 2 ? 'selected' : '' ; ?>>Template 2</option>
    <option value="3" <?= $template[0] == 3 ? 'selected' : '' ; ?>>Template 3</option>
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