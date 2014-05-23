<?php
depends::on(array("helper:template"));

class frontend {
    
    private $tpl;
    private $controller; 
    
    public function __construct() {
        $this->tpl   = helper::getInstance("template");
    }
    
    public function renderTemplate($tpl) {
        echo $this->tpl->render($tpl);
    }
    
}

?>