<?php

    class cart extends module {

        public $allowedMethods = array(
            "answer" => array( "type" => "POST" ),
            "comp" => array( "type" => "POST" ),
            "qty" => array( "type" => "POST" )
        );
        
        public function ___construct() {
            if (!isset($_SESSION["cartID"])) {

                $cartID = $this->db->select("SELECT MAX(CA_id) as 'max' FROM `cart` ");

                $cartID = $cartID["max"] + 1;

                $this->db->insert("
                    INSERT INTO cart (CA_id, CA_comp, CA_date, CA_qty, CA_ans) VALUES ($cartID, 0, UNIX_TIMESTAMP(), 0, 0);
                ");

                $_SESSION["cartID"] = $cartID;

            }
        }

        public function method_remove() {
            $this->db->delete("
                DELETE FROM cart WHERE CA_comp = :comp AND CA_ans = :ans AND CA_id = :id
            ", array(
                ":id" => $_SESSION["cartID"],
                ":comp" => $this->methodData->comp,
                ":ans" => $this->methodData->answer
            ));
            $this->error("Item removed!", "success");
        }

        public function method_add() {

            $qty = abs(intval($this->methodData->qty));

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
                ":id" => $this->methodData->comp
            ));

            if (!$competition) {
                return $this->error("Competition not found!");
            }
            
            $this->db->insert("
                INSERT INTO cart (CA_id, CA_comp, CA_date, CA_qty, CA_ans) VALUES (:id, :comp, UNIX_TIMESTAMP(), :qty, :answer)
                ON DUPLICATE KEY UPDATE CA_qty = CA_qty + :qty, CA_date = UNIX_TIMESTAMP();
            ", array(
                ":id" => $_SESSION["cartID"],
                ":answer" => $this->methodData->answer,
                ":comp" => $this->methodData->comp,
                ":qty" => $qty
            ));

            $this->error("Item added to your cart!", "success");

        }

        public function method_edit() {
            $qty = abs(intval($this->methodData->qty));
            if (!$qty) return $this->method_remove(); 
            $this->db->delete("
                UPDATE cart SET CA_qty = :qty WHERE CA_comp = :comp AND CA_ans = :ans AND CA_id = :id
            ", array(
                ":qty" => $qty,
                ":comp" => $this->methodData->comp,
                ":ans" => $this->methodData->answer,
                ":id" => $_SESSION["cartID"]
            ));
            $this->error("Item updated!", "success");
        }
        
        public function constructModule() {

            $total = 0;

            $cart = $this->db->selectAll("
                SELECT *, 
                    (CA_ans = 1) as 'ans1',
                    (CA_ans = 2) as 'ans2',
                    (CA_ans = 3) as 'ans3'
                FROM cart
                INNER JOIN competitions ON (CA_comp = C_id)
                WHERE CA_id = :id AND CA_qty > 0
            ", array(
                ":id" => $_SESSION["cartID"]
            ));

            foreach ($cart as $value) {
                $total += ($value["C_cost"] * $value["CA_qty"]);
            }

            $this->page->addToTemplate("cartQty", count($cart));
            $this->page->addToTemplate("cartTotal", number_format($total, 2));

            $this->html .= $this->page->buildElement("cart", array(
                "cart" => $cart, 
                "total" => number_format($total, 2)
            ));
        }
        
    }

?>