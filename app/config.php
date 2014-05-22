<?php
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//     _____ _           __ _             ____  _   _ ____      \\
//    |  ___(_)_ __ ___ / _| |_   _      |  _ \| | | |  _ \     \\
//    | |_  | | '__/ _ \ |_| | | | |_____| |_) | |_| | |_) |    \\
//    |  _| | | | |  __/  _| | |_| |_____|  __/|  _  |  __/     \\
//    |_|   |_|_|  \___|_| |_|\__, |     |_|   |_| |_|_|        \\
//                         |___/                                \\
//    -----------------------------------------------------     \\
//    Author: singh aka jba@derpunkt.de                         \\
//    Info: Contains all basic Configuration data               \\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// - - - - - - - - - - - - - - - - - 
// Database Data
conf::set("__DB_HOST" , "localhost");
conf::set("__DB_NAME" , "firefly");
conf::set("__DB_PWD"  , "derpunkt");
conf::set("__DB_USER" , "root");


// - - - - - - - - - - - - - - - - - 
// Base URL
conf::set("__BASE_URL" , "");


// - - - - - - - - - - - - - - - - - 
// Define Basic Paths
conf::set("__APP_DIR"        , "../app/");
conf::set("__HELPER_DIR"     , conf::get("__APP_DIR") . "helper/");
conf::set("__PLUGIN_DIR"     , conf::get("__APP_DIR") . "plugins/");
conf::set("__STORAGE_DIR"    , conf::get("__APP_DIR") . "storage/");
conf::set("__CONTROLLER_DIR" , conf::get("__APP_DIR") . "controller/");
conf::set("__LOG_DIR"        , conf::get("__STORAGE_DIR") . "logs/");


// - - - - - - - - - - - - - - - - - 
// Set log level (true : all | false : only errors)
conf::set("debug",true);

?>