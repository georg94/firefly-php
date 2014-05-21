<?php
// - - - - - - - - - - - - - - - - - 
// Load the singhRF 
require '../app/models.php';
require '../app/config.php';
require conf::get("__APP_DIR") . 'router.php';
require conf::get("__HELPER_DIR") . "instance.php";
$r = new router();
?>