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
//    Info: Class to instancen helper classes(static/non-static)\\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


depends::on(array("helper:paths"));

class helper
{
    private static $arrHelper = array();
    
    public static function getInstance($p)
    {
        if (!isset(self::$arrHelper[$p])) {
            require conf::get("__HELPER_DIR") . $p . "/" . $p . ".php";
            self::$arrHelper[$p] = new $p();
        }
        return self::$arrHelper[$p];
    }
    
    public static function getSingleInstance() {
        if (!isset(self::$arrHelper[$p])) {
            require conf::get("__HELPER_DIR") . $p . "/" . $p . ".php";
        }
        return new $p();
    }
    
}

?>