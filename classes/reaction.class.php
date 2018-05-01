<?php
    include_once("db.class.php");

    Class Reaction {
        private $reaction_text;
        private $user_id;
        private $post_id;

        /**
         * Get the value of reaction_text
         */ 
        public function getReaction_text()
        {
                return $this->reaction_text;
        }

        /**
         * Set the value of reaction_text
         *
         * @return  self
         */ 
        public function setReaction_text($reaction_text)
        {
                $this->reaction_text = $reaction_text;

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
         * Get the value of post_id
         */ 
        public function getPost_id()
        {
                return $this->post_id;
        }

        /**
         * Set the value of post_id
         *
         * @return  self
         */ 
        public function setPost_id($post_id)
        {
                $this->post_id = $post_id;

                return $this;
        }

        public function create() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO reactions (reaction_text, user_id, post_id) 
            VALUES (:reaction_text, :user_id, :post_id)");
            $statement->bindParam(':reaction_text', $this->reaction_text);
            $statement->bindParam(':user_id', $this->user_id);
            $statement->bindParam(':post_id', $this->post_id);
            $result = $statement->execute();
            return $result;
        }

        public function getReactionsOfPost($post_id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from reactions where post_id = :post_id");
            $statement->bindParam(":post_id", $post_id);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
    }
?>