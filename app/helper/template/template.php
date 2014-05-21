<?php
depends::on(array("helper:paths"));

class template {
    
    
    private $tplPath;
    
    
    public function __construct() {
        $this->tplPath = helper::getInstance("paths")->get("storage")."templates/";
    }
    
    public function render() {
        $dest=$this->tplPath . route::$path . ".html";
        if(file_exists($dest)) {
            return file_get_contents($dest);
        }
        
    }
    
    
    
}




?>