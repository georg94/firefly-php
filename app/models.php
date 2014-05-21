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
//    Info: Contains different System-Models/Classes            \\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -



// - - - - - - - - - - - - - - - -
// Config Model 
class conf {
    
    public static $arr = array();
    
    public static function set($name,$param){
        self::$arr[$name]=$param;
    }
    
    public static function get($name){
        if(isset(self::$arr[$name])) {
            return self::$arr[$name];
        }
        return false;
    }
    
}


// - - - - - - - - - - - - - - - -
// Params model

class params {
    
    private static $arrTypes = array("post","get");
    private static $post;
    private static $request;
    private static $get;
    private static $sanitations = array("numeric","alphanum");
    
    public static function init() {
        self::$post        = $_POST;
        self::$get         = $_GET;
        self::$request     = $_REQUEST;
    }
    
    public static function get($name,$type = false,$sanitation = false) {
        // - - - - - - - - - - - - - - - -
        //Check if type given, else 
        //return as part of $_Request
        if($type && in_array($type,self::$arrTypes)) {
            eval('$tmp = self::$'.$type.";");
        } else {
            $tmp = self::$request;
        }
        // - - - - - - - - - - - - - - - -
        //get the requested field
        if(!isset($tmp[$name])) {
            return false;
        }
        $tmp = $tmp[$name];
        // - - - - - - - - - - - - - - - -
        // check if sanitation is given
        if($sanitation && in_array($sanitation,self::$sanitations)) {
            eval('$tmp = self::' . $sanitation . '($tmp);');
        }
        return $tmp;
    }
    
    private function numeric($p) {
        if(is_numeric($p)) {
            return $p;
        }
        return false;
    }
    
    private function alphanum($p) {
        if(ctype_alnum($p)) {
            return $p;
        }
        return false; 
    }
    
}


// - - - - - - - - - - - - - - - -
// dependencies model

class depends {
    
    private static $arrDependencies = array();
    
    public static function on($arr) {
        if(is_array($arr)) {
            foreach($arr as $c) {
                $data=explode(":",$c);
                if(!isset(self::$arrDependencies[$c])) {
                    if(file_exists(helper::getInstance("paths")->get($data[0]) ."/".$data[1]."/".$data[1].".php")) {
                        self::$arrDependencies[$c] = true;
                    } else {
                        self::error($c);
                    }
                }
            }
        }
    }
    
    private function error($d) {
        die("Dependency " . $d . " could not be resolved");
    }
    
}

// - - - - - - - - - - - - - - - -
// route model
class route {
    
    public static $arrRoutes=array();    
    public static $controller;
    public static $plugin;
    public static $path;
    
        
    public static function add($route) {
        self::$arrRoutes[$route["path"]] = array("controller"=>$route["controller"],"plugin"=>$route["plugin"]);
    }
    
    public static function getRoute() {
        self::$path       = params::get("path","get");
        if(empty(self::$path)) {
            self::$path = "index";
        }
        self::$controller = self::$arrRoutes[self::$path]["controller"];
        self::$plugin     = self::$arrRoutes[self::$path]["plugin"];
    }
    
}

// - - - - - - - - - - - - - - - -
// route model
class log {
    
    private static $logpath;
    private static $logname = "application.log";
    
    public static function init() {
        self::$logpath = conf::get("__LOG_DIR");
        if(!file_exists(self::$logpath . self::$logname)) {
            file_put_contents(self::$logpath . self::$logname,"");
        }
    }
    
    public static function error($p) {
        self::write("error",$p);
    }
    
    public static function warning($p) {
        if(conf::get("debug") == true) {
            self::write("warning",$p);
        }
    }
    
    public static function info($p) {
        if(conf::get("debug") == true) {
            self::write("info",$p);
        }
    }
    
    private static function write($loglevel,$msg) {
        file_put_contents( self::$logpath . self::$logname , date("Y-m-d H:i:s") . " - " . $loglevel . " - " . $msg . "\r\n",FILE_APPEND); 
    }
    
}



?>