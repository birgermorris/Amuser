<?php
    include_once("db.class.php");
    Class Hashtag {
        private $hashtag_id;
        private $user_id;
        private $hashtag;
        private $follow_hashtag_id;

        

        /**
         * Get the value of hashtag_id
         */ 
        public function getHashtag_id()
        {
                return $this->hashtag_id;
        }

        /**
         * Set the value of hashtag_id
         *
         * @return  self
         */ 
        public function setHashtag_id($hashtag_id)
        {
                $this->hashtag_id = $hashtag_id;

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

        /**
         * Get the value of hashtag
         */ 
        public function getHashtag()
        {
                return $this->hashtag;
        }

        /**
         * Set the value of hashtag
         *
         * @return  self
         */ 
        public function setHashtag($hashtag)
        {
                $this->hashtag = $hashtag;

                return $this;
        }

        /**
         * Get the value of follow_hashtag_id
         */ 
        public function getFollow_hashtag_id()
        {
                return $this->follow_hashtag_id;
        }

        /**
         * Set the value of follow_hashtag_id
         *
         * @return  self
         */ 
        public function setFollow_hashtag_id($follow_hashtag_id)
        {
                $this->follow_hashtag_id = $follow_hashtag_id;

                return $this;
        }

        public function followHashtag() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO follow_hashtags (hashtag_id, user_id) VALUES (:hashtag_id, :user_id)");
            $statement->bindParam(':hashtag_id', $this->hashtag_id);
            $statement->bindParam(':user_id', $this->user_id);
            $result = $statement->execute();
            return $result;  
        }

        public function createHashtag() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO hashtags (hashtag) VALUES (:hashtag)");
            $statement->bindParam(':hashtag', $this->hashtag);
            $result = $statement->execute();
            return $result;
        }

        public function getHashtagInfo() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * from hashtags where hashtag like :hashtag");
            $statement->bindValue(':hashtag', $this->hashtag);
            $statement->execute();
            return $statement->fetch();
        }

        public function exists() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from hashtags where hashtag like :hashtag");
            $statement->bindValue(':hashtag', $this->hashtag);
            $statement->execute();
            $count = count($statement->fetchAll());

            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function checkIfFollow() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * from follow_hashtags where hashtag_id = :hashtag_id and user_id = :user_id");
            $statement->bindParam(':hashtag_id', $this->hashtag_id);
            $statement->bindParam(':user_id', $this->user_id);
            $statement->execute();
            $count = count($statement->fetchAll());

            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function unfollowHashtag() {
            $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE from follow_hashtags where hashtag_id = :hashtag_id and user_id = :user_id");
        $statement->bindParam(':hashtag_id', $this->hashtag_id);
        $statement->bindParam(':user_id', $this->user_id);
        $result = $statement->execute();
        return $result;
        }

        public function getMyHashtagFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT hashtag from follow_hashtags, hashtags where follow_hashtags.user_id = :user_id group by hashtags.id");
            $statement->bindParam("user_id", $this->user_id);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
    }
?>