<?php

    class adminModule {

        private function getNews($newsID = "all") {
            if ($newsID == "all") {
                $add = "";
            } else {
                $add = " WHERE P_id = :id";
            }
            
            $news = $this->db->prepare("
                SELECT
                    P_id as 'id',  
                    P_url as 'url',  
                    P_title as 'title',  
                    P_text as 'text'
                FROM pages
                " . $add . "
                ORDER BY P_id"
            );

            if ($newsID == "all") {
                $news->execute();
                return $news->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $news->bindParam(":id", $newsID);
                $news->execute();
                return $news->fetch(PDO::FETCH_ASSOC);
            }
        }

        private function validatenews($news) {
            $errors = array();
        
            if (strlen($news["url"]) < 2) {
                $errors[] = "URL link is to short, this must be atleast 3 characters.";
            } 
            if (strlen($news["title"]) < 2) {
                $errors[] = "Page title is to short, this must be atleast 3 characters.";
            } 
            if (strlen($news["text"]) < 10) {
                $errors[] = "Page text is to short, this must be atleast 10 characters.";
            } 

            return $errors;
            
        }

        public function method_new () {

            $news = array();

            if (isset($this->methodData->submit)) {
                $news = (array) $this->methodData;
                $errors = $this->validatenews($news);
                
                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->html .= $this->page->buildElement("error", array("text" => $error));
                    }
                } else {
                    $insert = $this->db->prepare("
                        INSERT INTO pages (P_title, P_text, P_url)  VALUES (:title, :text, :url);
                    ");
                    $insert->bindParam(":title", $this->methodData->title);
                    $insert->bindParam(":text", $this->methodData->text);
                    $insert->bindParam(":url", $this->methodData->url);
                    $insert->execute();

                    $this->html .= $this->page->buildElement("success", array("text" => "This page has been created"));

                }

            }

            $news["editType"] = "new";
            $this->html .= $this->page->buildElement("pageNotFoundNewForm", $news);
        }

        public function method_edit () {

            if (!isset($this->methodData->id)) {
                return $this->html = $this->page->buildElement("error", array("text" => "No page ID specified"));
            }

            $news = $this->getNews($this->methodData->id);

            if (isset($this->methodData->submit)) {
                $news = (array) $this->methodData;
                $errors = $this->validatenews($news);

                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->html .= $this->page->buildElement("error", array("text" => $error));
                    }
                } else {
                    $update = $this->db->prepare("
                        UPDATE pages SET P_url = :url, P_title = :title, P_text = :text WHERE P_id = :id
                    ");
                    $update->bindParam(":title", $this->methodData->title);
                    $update->bindParam(":text", $this->methodData->text);
                    $update->bindParam(":url", $this->methodData->url);
                    $update->bindParam(":id", $this->methodData->id);
                    $update->execute();

                    $this->html .= $this->page->buildElement("success", array("text" => "News post has been updated"));

                }

            }

            $news["editType"] = "edit";
            $this->html .= $this->page->buildElement("pageNotFoundNewForm", $news);
        }

        public function method_delete () {

            if (!isset($this->methodData->id)) {
                return $this->html = $this->page->buildElement("error", array("text" => "No page ID specified"));
            }

            $news = $this->getNews($this->methodData->id);

            if (!isset($news["id"])) {
                return $this->html = $this->page->buildElement("error", array("text" => "This page does not exist"));
            }

            if (isset($this->methodData->commit)) {
                $delete = $this->db->prepare("
                    DELETE FROM pages WHERE P_id = :id;
                ");
                $delete->bindParam(":id", $this->methodData->id);
                $delete->execute();

                header("Location: ?page=admin&module=pages");

            }


            $this->html .= $this->page->buildElement("pageNotFoundDelete", $news);
        }

        public function method_view () {

            $this->html .= $this->page->buildElement("pageNotFoundList", array(
                "pageNotFound" => $this->getNews()
            ));

        }

    }