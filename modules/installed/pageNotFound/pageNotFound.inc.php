<?php

    class pageNotFound extends module {
        
        public $allowedMethods = array();
        
        public function constructModule() {

            if (isset($_REQUEST["page"])) {
                $p = $_REQUEST["page"];
            } else {
                $p = $this->_settings->loadSetting("landingPage");
            }

            $page = $this->db->select("SELECT * FROM `pages` WHERE `P_url` = :page", array(
                ":page" => $p
            ));

            if ($page["P_text"]) {
                $this->pageName = $page["P_title"];
                return $this->html .= $this->page->buildElement("pageText", array(
                    "text" => $page["P_text"],
                    "title" => $page["P_title"]
                ));
            }

            $this->pageName = "Page Not Found!";

            $this->html .= $this->page->buildElement("pageNotFound");
        }
        
    }

?>