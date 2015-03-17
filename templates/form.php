<link href="<?= $css; ?>" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="<?= plugins_url('../js/konora.js', __FILE__); ?>"></script>
<script language="javascript" type="text/javascript">
   var plugin_konora_url = '<?= $plugin_url; ?>';
   var circle_id = '<?= $cirlce; ?>';
</script>

<div id="konora-wrapper-<?= $style; ?>">
    <form class="konora-form" action="<?= $konora; ?>/api/form/<?= $cirlce; ?>" method="GET" style="<?= $background; ?>;<?= $color; ?>;<?= $border_color; ?>">

        <?php if ($text != '') : ?>
           <p class="konora-text" style="display:block"><?= $text; ?></p>
        <?php endif; ?>

        <?php if (array_key_exists("name", $fields)) : ?>
           <p> 
               <?php if ($label != '') : ?>
                  <label for="konora-name" style="<?= $color; ?>;">Nome: </label>
               <?php endif; ?>

               <input id="konora-name" <?= $fields['name'] ? 'required' : ''; ?> placeholder="Inserisci il Nome" name="konora-name" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("surname", $fields)) : ?>
           <p> 
               <?php if ($label != '') : ?>
                  <label for="konora-surname" style="<?= $color; ?>;">Cognome: </label>
               <?php endif; ?>

               <input id="konora-surname" <?= $fields['surname'] ? 'required' : ''; ?> placeholder="Inserisci il Cognome" name="konora-surname" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("email", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-email" style="<?= $color; ?>;">E-Mail: </label>
               <?php endif; ?>

               <input id="konora-email" <?= $fields['email'] ? 'required' : ''; ?> placeholder="Inserisci l'E-Mail" name="konora-email" required type="email">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("phone", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-phone">Telefono: </label>
               <?php endif; ?>

               <input id="konora-phone" <?= $fields['phone'] ? 'required' : ''; ?> placeholder="Inserisci il Telefono" name="konora-phone" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("city", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-city">Citt&agrave;: </label>
               <?php endif; ?>

               <input id="konora-city" <?= $fields['city'] ? 'required' : ''; ?> placeholder="Inserisci la tua citt&agrave;" name="konora-city" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("note", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-note">Note: </label>
               <?php endif; ?>

               <textarea id="konora-note" <?= $fields['note'] ? 'required' : ''; ?> placeholder="Inserisci le note" name="konora-note"></textarea>
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("birthday", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-birthday">Compleanno: </label>
               <?php endif; ?>

               <input type="date" id="konora-birthday" <?= $fields['birthday'] ? 'required' : ''; ?>  name="konora-birthday" />
           </p>
        <?php endif; ?>

        <p>
            <?php if ($redirect != '') : ?>
               <input id="konora-redirect" name="konora-redirect" type="hidden" value="<?= $redirect; ?>">
            <?php endif; ?>
            <input id="konora-sponsor" name="konora-sponsor" type="hidden" value="<?= $sponsor; ?>">
            <input type = "submit" value="<?= $btn_text; ?>" style="<?= $btn_background; ?>;<?= $btn_color; ?>; " />
        </p>
    </form>
</div>