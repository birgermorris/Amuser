<?php
        include_once("db.class.php");

class User {
        private $firstname;
        private $lastname;
        private $password;
        private $user_id;

        

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
                $statement = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
                //$statement->bindParam(":user_id", $this->user_id);
                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

        public function update() {
                //DB connectie
                //QUERY
        }
    }

?>