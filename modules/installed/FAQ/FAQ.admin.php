<?php

    class adminModule {

        private function getFAQ($FAQID = "all") {
            if ($FAQID == "all") {
                $add = "";
            } else {
                $add = " WHERE FAQ_id = :id";
            }
            
            $FAQ = $this->db->prepare("
                SELECT
                    FAQ_id as 'id',    
                    FAQ_title as 'title',  
                    FAQ_text as 'text'
                FROM FAQ
                " . $add . "
                ORDER BY FAQ_id"
            );

            if ($FAQID == "all") {
                $FAQ->execute();
                return $FAQ->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $FAQ->bindParam(":id", $FAQID);
                $FAQ->execute();
                return $FAQ->fetch(PDO::FETCH_ASSOC);
            }
        }

        private function validateFAQ($FAQ) {
            $errors = array();
        
            if (strlen($FAQ["title"]) < 2) {
                $errors[] = "FAQ title is to short, this must be atleast 5 characters.";
            } 
            if (strlen($FAQ["text"]) < 10) {
                $errors[] = "FAQ text is to short, this must be atleast 10 characters.";
            } 

            return $errors;
            
        }

        public function method_new () {

            $FAQ = array();

            if (isset($this->methodData->submit)) {
                $FAQ = (array) $this->methodData;
                $errors = $this->validateFAQ($FAQ);
                
                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->html .= $this->page->buildElement("error", array("text" => $error));
                    }
                } else {
                    $insert = $this->db->prepare("
                        INSERT INTO FAQ (FAQ_title, FAQ_text)  VALUES (:title, :text);
                    ");
                    $insert->bindParam(":title", $this->methodData->title);
                    $insert->bindParam(":text", $this->methodData->text);
                    $insert->execute();

                    $this->html .= $this->page->buildElement("success", array("text" => "This FAQ entry has been created"));

                }

            }

            $FAQ["editType"] = "new";
            $this->html .= $this->page->buildElement("FAQNewForm", $FAQ);
        }

        public function method_edit () {

            if (!isset($this->methodData->id)) {
                return $this->html = $this->page->buildElement(
                    "error", array("text" => "No FAQ ID specified"
                ));
            }

            $FAQ = $this->getFAQ($this->methodData->id);

            if (isset($this->methodData->submit)) {
                $FAQ = (array) $this->methodData;
                $errors = $this->validateFAQ($FAQ);

                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->html .= $this->page->buildElement("error", array("text" => $error));
                    }
                } else {
                    $update = $this->db->prepare("
                        UPDATE FAQ SET FAQ_title = :title, FAQ_text = :text WHERE FAQ_id = :id
                    ");
                    $update->bindParam(":title", $this->methodData->title);
                    $update->bindParam(":text", $this->methodData->text);
                    $update->bindParam(":id", $this->methodData->id);
                    $update->execute();

                    $this->html .= $this->page->buildElement("success", array("text" => "FAQ post has been updated"));

                }

            }

            $FAQ["editType"] = "edit";
            $this->html .= $this->page->buildElement("FAQNewForm", $FAQ);
        }

        public function method_delete () {

            if (!isset($this->methodData->id)) {
                return $this->html = $this->page->buildElement("error", array("text" => "No FAQ ID specified"));
            }

            $FAQ = $this->getFAQ($this->methodData->id);

            if (!isset($FAQ["id"])) {
                return $this->html = $this->page->buildElement("error", array("text" => "This FAQ post does not exist"));
            }

            if (isset($this->methodData->commit)) {
                $delete = $this->db->prepare("
                    DELETE FROM FAQ WHERE FAQ_id = :id;
                ");
                $delete->bindParam(":id", $this->methodData->id);
                $delete->execute();

                header("Location: ?page=admin&module=FAQ");

            }


            $this->html .= $this->page->buildElement("FAQDelete", $FAQ);
        }

        public function method_view () {

            $this->html .= $this->page->buildElement("FAQList", array(
                "FAQ" => $this->getFAQ()
            ));

        }

    }