<?php

    class account extends module {
            
        public $allowedMethods = array(
            'submit'=>array('type'=>'post'),
            'same'=>array('type'=>'post'),
            'street'=>array('type'=>'post'),
            'line2'=>array('type'=>'post'),
            'city'=>array('type'=>'post'),
            'county'=>array('type'=>'post'),
            'postcode'=>array('type'=>'post'),
            'billStreet'=>array('type'=>'post'),
            'billLine2'=>array('type'=>'post'),
            'billCity'=>array('type'=>'post'),
            'billCounty'=>array('type'=>'post'),
            'billPostcode'=>array('type'=>'post')
        );
    
        public $pageName = '';
        
        public function constructModule() {
            
            $this->method_edit();

        }
        
        public function method_password() {
            $this->construct = false;

            if (!empty($this->methodData->submit)) {

                if (strlen($this->methodData->new) < 6) {
                    $this->alerts[] = $this->page->buildElement("error", array(
                        "text" => "The password you entered is too short, it must be atleast 6 characters."
                    ));
                } else if ($this->methodData->new != $this->methodData->confirm) {
                    $this->alerts[] = $this->page->buildElement("error", array(
                        "text" => "The passwords you entered do not match"
                    ));
                } else {
                    $encrypt = $this->user->encrypt($this->user->info->U_id . $this->methodData->old);
                    if ($encrypt != $this->user->info->U_password) {
                        $this->alerts[] = $this->page->buildElement("error", array(
                            "text" => "The password you entered is incorrect"
                        ));
                    } else {
                        $new = $this->user->encrypt($this->user->info->U_id . $this->methodData->new);

                        $update = $this->db->prepare("
                            UPDATE users SET U_password = :password WHERE U_id = :id
                        ");
                        $update->bindParam(":password", $new);
                        $update->bindParam(":id", $this->user->info->US_id);
                        $update->execute();
                        $this->alerts[] = $this->page->buildElement("success", array(
                            "text" => "Your password has been updated"
                        ));
                    }
                }
            }

            $this->html .= $this->page->buildElement("editPassword");
        }
        
        public function method_edit() {
            
            if (isset($this->methodData->submit)) {

                if (isset($this->methodData->same)) {
                    $this->methodData->billStreet = $this->methodData->street;
                    $this->methodData->billLine2 = $this->methodData->line2;
                    $this->methodData->billCity = $this->methodData->city;
                    $this->methodData->billCounty = $this->methodData->county;
                    $this->methodData->billPostcode = $this->methodData->postcode;
                }

                $this->db->update("
                    UPDATE userStats SET 
                        US_street = :street,
                        US_line2 = :line2,
                        US_city = :city,
                        US_county = :county,
                        US_postcode = :postcode,
                        US_billStreet = :billStreet,
                        US_billLine2 = :billLine2,
                        US_billCity = :billCity,
                        US_billCounty = :billCounty,
                        US_billPostcode = :billPostcode
                    WHERE US_id = :id
                ", array(
                    ":id" => $this->user->id,
                    ":street" => $this->methodData->street,
                    ":line2" => $this->methodData->line2,
                    ":city" => $this->methodData->city,
                    ":county" => $this->methodData->county,
                    ":postcode" => $this->methodData->postcode,
                    ":billStreet" => $this->methodData->billStreet,
                    ":billLine2" => $this->methodData->billLine2,
                    ":billCity" => $this->methodData->billCity,
                    ":billCounty" => $this->methodData->billCounty,
                    ":billPostcode" => $this->methodData->billPostcode
                ));

                $this->user->info->US_street = $this->methodData->street;
                $this->user->info->US_line2 = $this->methodData->line2;
                $this->user->info->US_city = $this->methodData->city;
                $this->user->info->US_county = $this->methodData->county;
                $this->user->info->US_postcode = $this->methodData->postcode;
                $this->user->info->US_billStreet = $this->methodData->billStreet;
                $this->user->info->US_billLine2 = $this->methodData->billLine2;
                $this->user->info->US_billCity = $this->methodData->billCity;
                $this->user->info->US_billCounty = $this->methodData->billCounty;
                $this->user->info->US_billPostcode = $this->methodData->billPostcode;
                
                $this->error('Addresses Updated!', 'success');
            
            }
            
            $this->construct = false;
            
            $this->pageName = 'Edit Profile';
        
            $this->html .= $this->page->buildElement("editProfile", array(
                "info" => (array) $this->user->info
            ));
            
        }
        
    }

?>