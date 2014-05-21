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
//    Info: Bootstrap the system (routes/params/etc)            \\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// - - - - - - - - - - - - - - - - - 
// initialice session
session_start();


// - - - - - - - - - - - - - - - - - 
// initialice database
helper::getInstance("database")->connect();


// - - - - - - - - - - - - - - - - - 
// initialice param model/class
params::init();


// - - - - - - - - - - - - - - - - - 
// Register routes 
route::add(array("path"       => "index",
                 "controller" => "index",
                 "plugin"     => "frontend"));

route::add(array("path"       => "test",
                 "controller" => "shows",
                 "plugin"     => "frontend"));

route::add(array("path"       => "gallery",
                 "controller" => "shows",
                 "plugin"     => "frontend"));

route::add(array("path"       => "wtf",
                 "controller" => "shows",
                 "plugin"     => "rest"));


// - - - - - - - - - - - - - - - - - 
// Get actual Call route 
route::getRoute();

// - - - - - - - - - - - - - - - - - 
// Init Logger modell/class
log::init();



?>

