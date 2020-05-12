<?php

    class adminModule {

        public function upload($id) {
            if (isset($_FILES["image"])) {
                $new = __DIR__ . "/images/" . $id . ".png";
                move_uploaded_file($_FILES["image"]["tmp_name"], $new);
            }
        }

        private function getCompetitions($competitionID = "all") {
            if ($competitionID == "all") {
                $add = "";
            } else {
                $add = " WHERE C_id = :id";
            }
            
            $competition = $this->db->prepare("
                SELECT
                    C_id as 'id',
                    C_date as 'date',
                    C_title as 'title',
                    C_text as 'text',
                    C_maxTickets as 'maxTickets',
                    C_maxPurchase as 'maxPurchase',
                    C_cost as 'cost',
                    C_correct as 'correct',
                    C_question as 'question',
                    C_ans1 as 'ans1',
                    C_ans2 as 'ans2',
                    C_ans3 as 'ans3'
                FROM competitions
                " . $add . "
                ORDER BY C_date DESC"
            );

            if ($competitionID == "all") {
                $competition->execute();
                $c = $competition->fetchAll(PDO::FETCH_ASSOC);
                foreach ($c as $k => $v) {
                    $c[$k]["date"] = date("Y-m-d H:i", $v["date"]); 
                }
                return $c; 
            } else {
                $competition->bindParam(":id", $competitionID);
                $competition->execute();
                $c = $competition->fetch(PDO::FETCH_ASSOC);
                $c["date"] = date("Y-m-d\TH:i:s", $c["date"]); 
                return $c;
            }
        }

        private function validateCompetition($competition) {
            $errors = array();
        
            /*if (strlen($competition["url"]) < 2) {
                $errors[] = "URL link is to short, this must be atleast 3 characters.";
            } 
            
            if (strlen($competition["title"]) < 2) {
                $errors[] = "Page title is to short, this must be atleast 3 characters.";
            } 
            
            if (strlen($competition["text"]) < 10) {
                $errors[] = "Page text is to short, this must be atleast 10 characters.";
            }*/

            return $errors;
            
        }

        public function method_new () {

            $competition = array();

            if (isset($this->methodData->submit)) {
                $competition = (array) $this->methodData;
                $errors = $this->validateCompetition($competition);
                
                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->html .= $this->page->buildElement("error", array("text" => $error));
                    }
                } else {
                    $insert = $this->db->prepare("
                        INSERT INTO competitions (C_date, C_title, C_text, C_maxTickets, C_maxPurchase, C_cost, C_question, C_ans1, C_ans2, C_ans3, C_correct)  VALUES (:date, :title, :text, :maxTickets, :maxPurchase, :cost, :question, :ans1, :ans2, :ans3, :correct);
                    ");
                    $time = strtotime($this->methodData->date);
                    $insert->bindParam(":date", $time);
                    $insert->bindParam(":title", $this->methodData->title);
                    $insert->bindParam(":text", $this->methodData->text);
                    $insert->bindParam(":maxTickets", $this->methodData->maxTickets);
                    $insert->bindParam(":maxPurchase", $this->methodData->maxPurchase);
                    $insert->bindParam(":cost", $this->methodData->cost);
                    $insert->bindParam(":question", $this->methodData->question);
                    $insert->bindParam(":ans1", $this->methodData->ans1);
                    $insert->bindParam(":ans2", $this->methodData->ans2);
                    $insert->bindParam(":ans3", $this->methodData->ans3);
                    $insert->bindParam(":correct", $this->methodData->correct);
                    $insert->execute();

                    $id = $this->db->lastInsertId();

                    $this->upload($id);

                    $this->html .= $this->page->buildElement("success", array("text" => "This competition has been created"));

                }

            }

            $competition["editType"] = "new";
            $this->html .= $this->page->buildElement("competitionsNewForm", $competition);
        }

        public function method_edit () {

            if (!isset($this->methodData->id)) {
                return $this->html = $this->page->buildElement("error", array("text" => "No page ID specified"));
            }

            $competition = $this->getCompetitions($this->methodData->id);

            if (isset($this->methodData->submit)) {
                $competition = (array) $this->methodData;
                $errors = $this->validateCompetition($competition);

                if (count($errors)) {
                    foreach ($errors as $error) {
                        $this->html .= $this->page->buildElement("error", array("text" => $error));
                    }
                } else {
                    $update = $this->db->prepare("
                        UPDATE competitions SET C_date = :date, C_title = :title, C_text = :text, C_maxTickets = :maxTickets, C_maxPurchase = :maxPurchase, C_cost = :cost, C_question = :question, C_ans1 = :ans1, C_ans2 = :ans2, C_ans3 = :ans3, C_correct = :correct WHERE C_id = :id
                    ");
                    $time = strtotime($this->methodData->date);
                    $update->bindParam(":date", $time);
                    $update->bindParam(":title", $this->methodData->title);
                    $update->bindParam(":text", $this->methodData->text);
                    $update->bindParam(":maxTickets", $this->methodData->maxTickets);
                    $update->bindParam(":maxPurchase", $this->methodData->maxPurchase);
                    $update->bindParam(":cost", $this->methodData->cost);
                    $update->bindParam(":question", $this->methodData->question);
                    $update->bindParam(":ans1", $this->methodData->ans1);
                    $update->bindParam(":ans2", $this->methodData->ans2);
                    $update->bindParam(":ans3", $this->methodData->ans3);
                    $update->bindParam(":correct", $this->methodData->correct);
                    $update->bindParam(":id", $this->methodData->id);
                    $update->execute();

                    $this->upload($this->methodData->id);

                    $this->html .= $this->page->buildElement("success", array("text" => "Competitions has been updated"));

                }

            }

            $competition["editType"] = "edit";
            $this->html .= $this->page->buildElement("competitionsNewForm", $competition);
        }

        public function method_delete () {

            if (!isset($this->methodData->id)) {
                return $this->html = $this->page->buildElement("error", array("text" => "No page ID specified"));
            }

            $competition = $this->getCompetitions($this->methodData->id);

            if (!isset($competition["id"])) {
                return $this->html = $this->page->buildElement("error", array("text" => "This page does not exist"));
            }

            if (isset($this->methodData->commit)) {
                $delete = $this->db->prepare("
                    DELETE FROM competitions WHERE C_id = :id;
                ");
                $delete->bindParam(":id", $this->methodData->id);
                $delete->execute();

                header("Location: ?page=admin&module=competitions");

            }


            $this->html .= $this->page->buildElement("competitionsDelete", $competition);
        }

        public function method_view () {

            $this->html .= $this->page->buildElement("competitionsList", array(
                "competitions" => $this->getCompetitions()
            ));

        }

    }