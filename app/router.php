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
//    Info: Core class , path router                            \\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

class router {
    
    private $paths;
    private $routes;
    
    public function __construct() {
        
        // - - - - - - - -  - - - - 
        // get needeed helpers
        $this->paths = helper::getInstance("paths");
        
        // - - - - - - - - - - - - - - -
        // run the bootstrap
        $this->loadRes($this->paths->get("app")."bootstrap.php");
        
        // - - - - - - - - - - - - - - -
        // Start process
        $this->performRoute();
        
    }
    
    private function performRoute() {
        $this->loadRes($this->paths->get("controller") . route::$controller . "/" . route::$controller . ".php");
        $this->loadRes($this->paths->get("plugin") . route::$plugin . "/" . route::$plugin . ".php");
        new route::$controller(new route::$plugin());
    }
    
    
    private function loadRes($p) {
        if(file_exists($p)) {
            require($p);
        } else {
            die($p . " doesnt exist");
        }
    }
    
}


?>