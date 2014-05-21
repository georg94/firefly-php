<?php
depends::on(array("helper:template"));

class frontend {
    
    private $tpl;
    private $controller; 
    
    public function __construct($obj) {
        $this->tpl   = helper::getInstance("template");
        $this->data = $obj->data;
        $this->renderOutput($this->data);
    }
    
    private function renderOutput() {
        echo $this->tpl->render($this->data);
    }
    
}

?>