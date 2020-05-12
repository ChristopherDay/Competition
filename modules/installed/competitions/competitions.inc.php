<?php

    class competitions extends module {
        
        public $allowedMethods = array(
            "id" => array( "type" => "GET" )
        );
        
        public function constructModule() {

            $competitions = $this->db->selectAll("
                SELECT
                    C_id as 'id',
                    C_date as 'date',
                    C_title as 'title',
                    C_text as 'text',
                    C_maxTickets as 'maxTickets',
                    C_maxPurchase as 'maxPurchase',
                    C_cost as 'cost',
                    C_question as 'question',
                    C_ans1 as 'ans1',
                    C_ans2 as 'ans2',
                    C_ans3 as 'ans3'
                FROM competitions
                WHERE C_date > UNIX_TIMESTAMP()
                ORDER BY C_date DESC
            ");

            foreach ($competitions as $key => $value) {
                $value["date"] = date("jS F, h:ia", $value["date"]);
                $competitions[$key] = $value;
            }

            $this->html .= $this->page->buildElement("competitions", array(
                "competitions" => $competitions
            ));
        }

        public function method_view() {

            $this->construct = false;

            $competition = $this->db->select("
                SELECT
                    C_id as 'id',
                    C_date as 'date',
                    C_title as 'title',
                    C_text as 'text',
                    C_maxTickets as 'maxTickets',
                    C_maxPurchase as 'maxPurchase',
                    C_cost as 'cost',
                    C_question as 'question',
                    C_ans1 as 'ans1',
                    C_ans2 as 'ans2',
                    C_ans3 as 'ans3'
                FROM competitions
                WHERE C_id = :id
            ", array(
                ":id" => $this->methodData->id
            ));

            if (!$competition) {
                return $this->error("Competition not found!");
            }
            
            $competition["locked"] = $competition["date"] < time();
            $competition["entries"] = array();

            $i = 1;
            while ($i <= $competition["maxPurchase"]) {
                $competition["entries"][] = array( "number" => $i );
                $i++;
            }

            $competition["date"] = date("jS F, h:ia", $competition["date"]);

            $this->html .= $this->page->buildElement("competition", $competition);

        }
        
    }

?>