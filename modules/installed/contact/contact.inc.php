<?php

    class contact extends module {
        
        public $allowedMethods = array(
            "name"      => array( "type" => "POST" ),
            "email"     => array( "type" => "POST" ),
            "subject"   => array( "type" => "POST" ),
            "body"      => array( "type" => "POST" )
        );
        
        public function constructModule() {
            $this->html .= $this->page->buildElement("contactUs", array(
                "name" => isset($this->methodData->name)?$this->methodData->name:"",
                "email" => isset($this->methodData->email)?$this->methodData->email:"",
                "subject" => isset($this->methodData->subject)?$this->methodData->subject:"",
                "body" => isset($this->methodData->body)?$this->methodData->body:""
            ));
        }
        
        public function method_email() {

            if (!filter_var($this->methodData->email, FILTER_VALIDATE_EMAIL)) {
                return $this->error('Please enter a valid email address');
            }

            if (strlen($this->methodData->subject) < 3) {
                return $this->error('Your subject should be atleast 3 characters long'); 
            }
            
            if (strlen($this->methodData->name) < 5) {
                return $this->error("Please enter your full name!");
            }
            
            if (strlen($this->methodData->body) < 10) {
                return $this->error("Your enquiry should be atleast 10 characters long!");
            }

            $this->error("Email sent!", "success");

        }
    }

?>