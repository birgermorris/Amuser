<?php
include_once("db.class.php");

class User {
        private $firstname;
        private $lastname;
        private $email;
        private $bio;
        private $image;
        private $password;
        private $user_id;

        //TEMP FILES FOR IMAGE UPLOAD
        private $ImageName;
        private $ImageSize;
        private $ImageTmpName;

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of user_id
         */ 
        public function getUser_id()
        {
                return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser_id($user_id)
        {
                $this->user_id = $user_id;
                return $this;
        }

        public function getUserInfo() {
                //DB CONNECTIE
                $conn = Db::getInstance();

                //QUERY WHERE USER = $_SESSION
                $statement = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
                $statement->bindParam(":user_id", $this->user_id);
                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

        public function update() {
                //DB CONNECTIE
                $conn = Db::getInstance();

                //WACHTWOORD WIJZIGEN
                

                //QUERY UPDATE
                $statement = $conn->prepare("UPDATE users SET firstname = :firstname,lastname=:lastname,email=:email,password=:password,bio=:bio,image=:image WHERE id = :user_id");
                $statement->bindParam(":user_id", $this->user_id);
                $statement->bindParam(":firstname", $this->firstname);
                $statement->bindParam(":lastname", $this->lastname);
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password", $this->password);
                $statement->bindParam(":bio", $this->bio);
                $statement->bindParam(":image", $this->image);
                $statement->execute();
                return $statement;
        }

        public function login(){
    
                $conn = Db::getInstance();

                //QUERY UPDATE
                $statement = $conn->prepare("select * from users where email = :email");
                $statement->bindParam(":email", $this->email);
                $statement->execute();

                //$query = "select * form users where email = '".$conn->real_escape_string($username)."'";
                $result = $statement->fetch();
        
                $this->setUser_id($result["id"]);
                
                if( password_verify($this->password, $result['password'])){
                    return true;
                }
                else {
                    return false;
                }
            
            }

        public function create() {
                //CREATE USER
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of bio
         */ 
        public function getBio()
        {
                return $this->bio;
        }

        /**
         * Set the value of bio
         *
         * @return  self
         */ 
        public function setBio($bio)
        {
                $this->bio = $bio;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        //save profile image into folder profile
        public function SaveProfileImg() {
                $file_name = $_SESSION['user_id'] . "-" . time() . "-" . $this->ImageName;
                $file_size = $this->ImageSize;
                $file_tmp = $this->ImageTmpName;
                $tmp = explode('.', $file_name);
                $file_ext = end($tmp);
                $expensions = array("jpeg", "jpg", "png", "gif");
        
                if (in_array($file_ext, $expensions) === false) {
                        throw new Exception("extension not allowed, please choose a JPEG or PNG or GIF file.");
                }
        
                if ($file_size > 2097152) {
                        throw new Exception('File size must be excately 2 MB');
                }
        
                if (empty($errors) == true) {
                        move_uploaded_file($file_tmp, "data/profile/" . $file_name);
                        return "data/profile/" . $file_name;
                } else {
                        echo "Error";
                }
    }

        /**
         * Get the value of ImageName
         */ 
        public function getImageName()
        {
                return $this->ImageName;
        }

        /**
         * Set the value of ImageName
         *
         * @return  self
         */ 
        public function setImageName($ImageName)
        {
                $this->ImageName = $ImageName;

                return $this;
        }

        /**
         * Get the value of ImageSize
         */ 
        public function getImageSize()
        {
                return $this->ImageSize;
        }

        /**
         * Set the value of ImageSize
         *
         * @return  self
         */ 
        public function setImageSize($ImageSize)
        {
                $this->ImageSize = $ImageSize;

                return $this;
        }

        /**
         * Get the value of ImageTmpName
         */ 
        public function getImageTmpName()
        {
                return $this->ImageTmpName;
        }

        /**
         * Set the value of ImageTmpName
         *
         * @return  self
         */ 
        public function setImageTmpName($ImageTmpName)
        {
                $this->ImageTmpName = $ImageTmpName;

                return $this;
        }
    }

?>