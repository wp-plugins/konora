<link href="<?= $css; ?>" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="<?= plugins_url('../js/konora.js', __FILE__); ?>"></script>
<script language="javascript" type="text/javascript">
   var plugin_konora_url = '<?= $plugin_url; ?>';
</script>

<div id="konora-wrapper-<?= $style; ?>">
    <form class="konora-form" action="<?= $konora; ?>/api/form/<?= $cirlce; ?>" method="GET" style="<?= $background; ?>;<?= $color; ?>;<?= $border_color; ?>">

        <?php if ($text != '') : ?>
           <p class="konora-text" style="display:block"><?= $text; ?></p>
        <?php endif; ?>

        <?php if (in_array("name", $fields)) : ?>
           <p> 
               <?php if ($label != '') : ?>
                  <label for="konora-name" style="<?= $color; ?>;">Nome: </label>
               <?php endif; ?>

               <input id="konora-name" placeholder="Inserisci il Nome" name="konora-name" type="text">
           </p>
        <?php endif; ?>

        <?php if (in_array("email", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-email" style="<?= $color; ?>;">E-Mail: </label>
               <?php endif; ?>

               <input id="konora-email" placeholder="Inserisci l'E-Mail" name="konora-email" required type="email">
           </p>
        <?php endif; ?>

        <?php if (in_array("phone", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "konora-email">Telefono: </label>
               <?php endif; ?>

               <input id="konora-phone" placeholder="Inserisci il Telefono" name="konora-phone" type="number">
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