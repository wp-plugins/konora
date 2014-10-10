<link href="<?= $css; ?>" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
   var plugin_konora_url = '<?= $plugin_url; ?>';
</script>

<div id="konora-wrapper-<?= $style; ?>">
    <form class="konora-form" action="<?= $konora; ?>/api/form/<?= $cirlce; ?>" method="GET" style="<?= $background; ?>;<?= $color; ?>;<?= $border_color; ?>">

        <?php if ($text != '') : ?>
           <p style="display:block"><?= $text; ?></p>
        <?php endif; ?>
           
        <p>
            <?php if ($label != '') : ?>
               <label for="konora-name">Nome: </label>
            <?php endif; ?>

            <input id="konora-name" placeholder="inserisci il nome" name="konora-name" type="text">
        </p>
        <p>
            <?php if ($label != '') : ?>
               <label for = "konora-email">E-Mail: </label>
            <?php endif; ?>

            <input id="konora-email" placeholder="Inserisci l'E-Mail" name="konora-email" required type="text">
        </p>
        <p>
            <input type = "submit" value="<?= $btn_text; ?>" style="<?= $btn_background; ?>;<?= $btn_color; ?>; ">
        </p>
    </form>
</div>

