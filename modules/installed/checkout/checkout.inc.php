<?php

    class checkout extends module {
        
        public $allowedMethods = array();
        
        public function constructModule() {
            $this->html .= $this->page->buildElement("checkout");
        }
        
    }

?>