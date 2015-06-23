<link href="<?= $css; ?>" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="<?= plugins_url('../js/konora.js', __FILE__); ?>"></script>
<script language="javascript" type="text/javascript">
   var plugin_konora_url = '<?= $plugin_url; ?>';
   var circle_id = '<?= $cirlce; ?>';
</script>

<div id="konora-wrapper-<?= $style; ?>">
    <form class="konora-form" action="<?= plugins_url( 'form.php', dirname(__FILE__)  ); ?>" method="GET" style="<?= $background; ?>;<?= $color; ?>;<?= $border_color; ?>">

        <img src="http://knr.cc/form/pixel/<?= $cirlce; ?>.jpeg" style="position:absolute; visibility:hidden">
        
        <?php if ($text != '') : ?>
           <p class="konora-text" style="display:block"><?= $text; ?></p>
        <?php endif; ?>

        <?php if (array_key_exists("name", $fields)) : ?>
           <p> 
               <?php if ($label != '') : ?>
                  <label for="name" style="<?= $color; ?>;">Nome: </label>
               <?php endif; ?>

               <input id="name" <?= $fields['name'] ? 'required' : ''; ?> placeholder="Inserisci il Nome" name="name" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("surname", $fields)) : ?>
           <p> 
               <?php if ($label != '') : ?>
                  <label for="surname" style="<?= $color; ?>;">Cognome: </label>
               <?php endif; ?>

               <input id="surname" <?= $fields['surname'] ? 'required' : ''; ?> placeholder="Inserisci il Cognome" name="surname" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("email", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "email" style="<?= $color; ?>;">E-Mail: </label>
               <?php endif; ?>

               <input id="email" <?= $fields['email'] ? 'required' : ''; ?> placeholder="Inserisci l'E-Mail" name="email" required type="email">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("phone", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "phone">Telefono: </label>
               <?php endif; ?>

               <input id="phone" <?= $fields['phone'] ? 'required' : ''; ?> placeholder="Inserisci il Telefono" name="phone" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("city", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "address_city_1">Citt&agrave;: </label>
               <?php endif; ?>

               <input id="address_city_1" <?= $fields['city'] ? 'required' : ''; ?> placeholder="Inserisci la tua citt&agrave;" name="address_city_1" type="text">
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("address", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "address">Indirizzo: </label>
               <?php endif; ?>
           <div>
               <input id="address_street_1" <?= $fields['address'] ? 'required' : ''; ?> placeholder="Via" name="address_street_1" type="text" >
               <input id="address_city_1" <?= $fields['address'] ? 'required' : ''; ?> placeholder="Città" name="address_city_1" type="text" >
           </div>
           <div>
               <input id="address_district_1" <?= $fields['address'] ? 'required' : ''; ?> placeholder="Provincia" name="address_district_1">
               <input id="address_postcode_1" <?= $fields['address'] ? 'required' : ''; ?> placeholder="CAP" name="address_postcode_1" >
           </div>
           <div>
               <input id="address_state_1" <?= $fields['address'] ? 'required' : ''; ?> placeholder="Stato" name="address_state_1">
           </div>
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("note", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "note">Note: </label>
               <?php endif; ?>

               <textarea id="note" <?= $fields['note'] ? 'required' : ''; ?> placeholder="Inserisci le note" name="note"></textarea>
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("birthday", $fields)) : ?>
           <p>
               <?php if ($label != '') : ?>
                  <label for = "birthday_day">Compleanno: </label>
               <?php endif; ?>

               <input type="date" id="birthday_day" <?= $fields['birthday'] ? 'required' : ''; ?>  name="birthday_day" />
           </p>
        <?php endif; ?>

        <?php if (array_key_exists("signup", $fields) and !is_null($fields['signup'])) : ?>
           <p>
               <input type="hidden" id="signup" value="<?= $fields['signup']; ?>"  name="signup" />
           </p>
        <?php endif; ?>
           
        <?php if (array_key_exists("pack", $fields) and !is_null($fields['pack'])) : ?>
           <p>
               <input type="hidden" id="pack" value="<?= $fields['pack']; ?>"  name="pack" />
           </p>
        <?php endif; ?>
           
        <?php if (array_key_exists("recurrence", $fields) and !is_null($fields['recurrence'])) : ?>
           <p>
               <input type="hidden" id="recurrence" value="<?= $fields['recurrence']; ?>"  name="recurrence" />
           </p>
        <?php endif; ?>

        <p>
            <?php if ($redirect != '') : ?>
               <input id="redirect" name="redirect" type="hidden" value="<?= $redirect; ?>">
            <?php endif; ?>
            <input id="sponsor" name="sponsor" type="hidden" value="<?= $sponsor; ?>">
            <input id="id_circle" name="id_circle" type="hidden" value="<?= $cirlce; ?>">
            <input type = "submit" value="<?= $btn_text; ?>" style="<?= $btn_background; ?>;<?= $btn_color; ?>; " />
        </p>
    </form>
</div>
