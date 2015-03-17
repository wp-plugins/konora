<?php

function konora_admin_init() {
   setcookie("sponsor", null, NULL, '/', '.' . second_level());
}
