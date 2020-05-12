<?php

    $__userCache = array();

    class user {
        
        public $id, $info, $name, $db, $loggedin = false, $nextRank, $user;
        
        // Pass the ID to the class
        function __construct($id = FALSE, $name = FALSE) {

            global $db, $__userCache;
            
            if ($id && isset($__userCache[$id])) {
                foreach(get_object_vars($__userCache[$id]) as $k => $v){
                    $this->{$k}=$v;
                }
                return;
            } 
            
            $this->db = $db;
            
            if (isset($id) || isset($name)) {
                $this->id = $id;
                $this->name = $name;
                $this->getInfo();    
                
                if (isset($_SESSION['userID']) && $_SESSION['userID'] == $this->id) {
                    $this->loggedin = true;
                }

            }

            $__userCache[$id] = &$this;

        }    
        
        // This function will return all the information for the user
        public function getInfo($return = false) {
            
            if (!empty($this->name)) {
                $userInfo = $this->db->prepare("
                    SELECT 
                        *
                    FROM 
                        users 
                        LEFT OUTER JOIN userStats ON (U_id = US_id) 
                        LEFT OUTER JOIN userRoles ON (UR_id = U_userLevel)
                    WHERE 
                        U_name = :userName
                ");
                $userInfo->bindParam(':userName', $this->name);
            } else {
                $userInfo = $this->db->prepare("
                    SELECT 
                        *
                    FROM 
                        users 
                        LEFT OUTER JOIN userStats ON (U_id = US_id) 
                        LEFT OUTER JOIN userRoles ON (UR_id = U_userLevel)
                    WHERE 
                        U_id = :userID
                ");
                $userInfo->bindParam(':userID', $this->id);
            }
            
            $userInfo->execute();
            
            $this->info = $userInfo->fetchObject();

            $access = array();
            if (isset($this->info->U_userLevel)) {
                $adminModules = $this->db->prepare("
                    SELECT * FROM roleAccess WHERE RA_role = :id;
                ");
                $adminModules->bindParam(":id", $this->info->U_userLevel);
                $adminModules->execute();
                $adminModules = $adminModules->fetchAll(PDO::FETCH_ASSOC);

                foreach ($adminModules as $key => $value) {
                    $access[] = $value["RA_module"];
                }

            }

            $this->adminModules = $access;
            
            if (isset($user->info->U_name) || isset($user->info->U_id)) {
                $this->id = $this->info->U_id;
                $this->name = $this->info->U_name;
            }
    	    
            $pic = $this->getProfilePicture();

            if (isset($this->info->U_name)) {
                $this->user = array(
                    "name" => $this->info->U_name,
                    "id" => $this->info->U_id,
                    "userLevel" => $this->info->U_userLevel,
                    "status" => $this->info->U_status, 
                    "color" => $this->info->UR_color, 
                    "profilePicture" => $pic, 
                    "onlineStatus" => $this->getStatus(false)
                );
            }
            
            if ($return) {
                return $this->info;
            }
            
        }
        
        public function hasAdminAccessTo($module) {
            return in_array($module, $this->adminModules) || in_array("*", $this->adminModules);
        }

        public function encrypt($var) {
            return hash('sha256', $var);
        }
        
        public function makeUser($username, $email, $password, $userLevel = 1, $userStatus = 1) {
            
            $settings = new settings();

            $check = $this->db->prepare("SELECT U_id FROM users WHERE U_name = :username OR (U_email = :email AND U_status = 1)");
            $check->bindParam(':username', $username);    
            $check->bindParam(':email', $email);    
            $check->execute();
            $checkInfo = $check->fetchObject();
            
            if (isset($checkInfo->U_id)) {
                
                return 'Username or EMail are in use!';
                
            } else {

                $validateUserEmail = !!$settings->loadSetting("validateUserEmail");
                
                if ($validateUserEmail) {
                    $userStatus = 2;
                }

                $addUser = $this->db->prepare("
                    INSERT INTO users (U_name, U_email, U_userLevel, U_status) 
                    VALUES (:username, :email, :userLevel, :userStatus)
                ");
                $addUser->bindParam(':username', $username);
                $addUser->bindParam(':email', $email);
                $addUser->bindParam(':userLevel', $userLevel);
                $addUser->bindParam(':userStatus', $userStatus);
                $addUser->execute();

                $id = $this->db->lastInsertId();
                $this->id = $id;
                
                $encryptedPassword = $this->encrypt($id . $password);

                $addUserPassword = $this->db->prepare("
                    UPDATE users SET U_password = :password WHERE U_id = :id
                ");
                $addUserPassword->bindParam(':id', $id);
                $addUserPassword->bindParam(':password', $encryptedPassword);
                $addUserPassword->execute();

                $this->db->query("INSERT INTO userStats (US_id) VALUES (" . $id . ")");

                $this->updateTimer("signup", time());

                if ($validateUserEmail) {
                    $this->sendActivationCode($email, $id, $username);
                }

                $hook = new Hook("newUser");
                $hook->run($id);
                
                return $id;
                
            }
            
        }
        
        public function sendActivationCode($email, $id, $username) {
            $gameName = $settings->loadSetting("game_name");
            $activationCode = $this->activationCode($id, $username);
            $subject = $gameName . " - Registration";
            $body = "$username your activation code for $gameName is $activationCode, after you have logged in please enter this when prompted.";
            mail($email, $subject, $body);
        }

        public function activationCode($id, $username) {
            return substr($this->encrypt($id . $username), 0, 6);
        }

        public function getNotificationCount($id) {
                
            global $page;
            
            $notifications = $this->db->prepare("SELECT COUNT(N_id) as count FROM notifications WHERE N_uid = :user1 AND N_read = 0");
            $notifications->bindParam(':user1', $id);
            $notifications->execute();
            $result = $notifications->fetchObject();
            
            $page->addToTemplate('notificationCount', $result->count);
            return $result->count;

        }

        public function getProfilePicture() {

            if (isset($this->info->profilePictureChecked)) return $this->info->US_pic;

            $image = @new FastImage($this->info->US_pic);
            $size = $image->getSize();

            if (!isset($size[0])) {
                $this->info->US_pic = "themes/" . _setting("theme") . "/images/default-profile-picture.png";
            }

            $this->info->profilePictureChecked = true;

            return $this->info->US_pic;

        }
        
        public function bindVarsToTemplate() {
            
            global $page;
            
            $this->getNotificationCount($this->info->U_id); 

            $pic = $this->getProfilePicture();

            $page->addToTemplate('username', $this->info->U_name);
            $page->addToTemplate('userStatus', $this->info->U_status);
            $page->addToTemplate('user', $this->user);

            $page->addToTemplate('isAdmin', count($this->adminModules) != 0);
            
            $hook = new Hook("userInformation");

            $hook->run($this);
            
        }
        
        
        public function set($stat, $value) {

            if ($stat[1] == "_") {
                $table = "users";
                $id = "U_id";
            } else {
                $table = "userStats";
                $id = "US_id";
            }

            $query = $this->db->prepare("UPDATE $table SET $stat = :value WHERE $id = :id");
            $query->bindParam(":id", $this->info->US_id);
            $query->bindParam(":value", $value);
            $query->execute();

            $this->info->$stat = $value;

        }

        public function add($value, $stat) {
            $this->set($stat, $this->info->$stat + $value);
        }

        public function subtract($value, $stat) {
            $this->set($stat, $this->info->$stat + $value);
        }

        public $counter = 0;
    
        public function newNotification($text) {
            $notification = $this->db->prepare("
                INSERT INTO notifications (
                    N_uid, N_text, N_read, N_time
                ) VALUES (
                    :id, :text, 0, UNIX_TIMESTAMP()
                );
            ");
            $notification->bindParam(":id", $this->info->U_id);
            $notification->bindParam(":text", $text);
            $notification->execute();
        }

        public function checkTimer($timer) {
            $time = $this->getTimer($timer);
            return (time() > $time);
        }
        
        public function getTimer($timer, $make = true) {
        
            $userID = $this->id;
            
            if (!$userID) $userID = $this->info->U_id;

            $select = $this->db->prepare("
                SELECT * FROM userTimers WHERE UT_desc = :desc AND UT_user = :user;
            ");
            $select->bindParam(':user', $userID);
            $select->bindParam(':desc', $timer);
            $select->execute();
            
            $array = $select->fetch(PDO::FETCH_ASSOC);
            
            // If the array is empty we make the user timer, this way the developer does not have to make any changes to the database to make a new timer.
            if (empty($array['UT_time'])) {
                if ($make) {
                    $time = time()-1;
                    $insert = $this->db->prepare("INSERT INTO userTimers (UT_user, UT_desc, UT_time) VALUES (:user, :desc, :time)");
                    $insert->bindParam(':user', $userID);
                    $insert->bindParam(':desc', $timer);
                    $insert->bindParam(':time', $time);
                    $insert->execute();
                    return $time;
                } else {
                    return 0;
                }
                
            } else {
                
                return $array['UT_time'];
                
            }
            
        }
        
        public function updateTimer($timer, $time, $add = false) {
        
            $user = $this->id;
            
            if (!$user) $user = $this->info->U_id;
            
            // Check that the timer exists, if it dosent this function will automaticly make it.
            // We do this so the user does not have to make any database changes to make a module.
            $oldTimer = $this->getTimer($timer);

            if ($add) {
                $time = time() + $time;
            }
            
            $update = $this->db->prepare("UPDATE userTimers SET UT_time = :time WHERE UT_user = :user AND UT_desc = :desc");
            $update->bindParam(':time', $time);
            $update->bindParam(':user', $user);
            $update->bindParam(':desc', $timer);
            $update->execute();

            $hook = new Hook("userTimerUpdated");
            $data = array(
                "timer" => $timer, 
                "time" => $time, 
                "user" => $user
            );
            $hook->run($data);
            
        }

        public function getStatus($returnElement = true, $time = false) {
            
            if (!$time) {
                $time =(time() - $this->getTimer("laston"));
            }
            global $page;
            
            if ($time > 300 && $time <= 900) {
                if ($returnElement) {
                    return $page->buildElement("AFK", array());
                } else {
                    return 1;
                }
            } else if ($time > 900) {
                if ($returnElement) {
                    return $page->buildElement("offline", array());
                } else {
                    return 0;
                }
            } else {
                if ($returnElement) {
                    return $page->buildElement("online", array());
                } else {
                    return 2;
                }
            }
            
        }
        
        public function logout() {
        
            session_destroy();
            
        }
        
    }
    
?>
