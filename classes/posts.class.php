<?php 
include_once("db.class.php");
    Class Posts {
        public $src = "data/post/";
        public $tmp;
        public $image;
        public $image_text;
        public $type;
        public $uploadfile;
        public $target_file;
        public $imageFileType;
        public $user_id;
        public $post_id;

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

        /**
         * Get the value of image_text
         */ 
        public function getImage_text()
        {
                return $this->image_text;
        }

        /**
         * Set the value of image_text
         *
         * @return  self
         */ 
        public function setImage_text($image_text)
        {
                $this->image_text = $image_text;

                return $this;
        }
        public function PhotoUpload(){
            $conn = Db::getInstance();

            $this->target_file = $this->src . preg_replace("![^a-z0-9]+!i", "_",basename($this->tmp["name"]));
            if(move_uploaded_file($this->tmp["tmp_name"], $this->target_file)){
                $query = "insert into posts (image, image_text, upload_time, user_id) values (:image, :image_text, :upload_time, :user_id) ";
                $statement = $conn->prepare($query);
                $statement->bindValue(':image', $this->target_file);
                $statement->bindValue(':image_text', $this->image_text);
                $statement->bindValue(":user_id", $this->user_id);
                $statement->bindValue(':upload_time', date("Y-m-d H:i:s"));
                $res = $statement->execute();
                return $res;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        public function removePicture(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("delete * from posts where user_id = :user_id");
            $statement->bindParam(":user_id", $user_id);
            $result = $statement->execute();
            return $result;

        }

        // posts limit by 20 on the index page
        public static function getAll() {
            $conn = Db::getInstance();
            $limitposts = 20;
            $statement = $conn->prepare("select * from posts ORDER BY upload_time DESC limit $limitposts");
            $statement->execute();
            $result = $statement->fetchAll( PDO::FETCH_ASSOC );
            return $result;
        }
        public function getMore(){
                
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
    }
