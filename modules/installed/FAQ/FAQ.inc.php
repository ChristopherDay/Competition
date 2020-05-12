<?php

    class FAQ extends module {
        
        public $allowedMethods = array();
        
        public $pageName = 'Welcome back';
        
        public function constructModule() {
            
            $FAQ = $this->db->prepare("SELECT * FROM FAQ");
            $FAQ->execute();
            $articleInfo = array();
            while ($FAQArticle = $FAQ->fetch(PDO::FETCH_ASSOC)) {
                
                $articleInfo[] = array(
                    "title" => $FAQArticle['FAQ_title'],
                    "text" => $FAQArticle['FAQ_text']
                );
                
            }
            
            $this->html .= $this->page->buildElement('FAQArticle', array(
                "FAQ" => $articleInfo
            ));
        
        }
        
    }

?>