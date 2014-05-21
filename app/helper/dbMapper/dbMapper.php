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
//    Info: System Helper to distinct use of database/tables    \\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

class dbMapper {
    
    private static $arrTables = array();
    
    public static function get($p) {
        if(!isset(self::$arrTables[$p])) {
            $fullPath = helper::getInstance("paths")->get("helper") . "dbMapper/tables/" . $p . "Mapper.php";
            if(file_exists($fullPath)) {
                require $fullPath;
                $n= $p."Mapper";
                self::$arrTables[$p] = new $n();
            }
        }
        return self::$arrTables[$p];
    }
}
?>