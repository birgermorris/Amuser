<?php 
include_once("db.class.php");
    Class Posts {
        private $src = "data/post/";
        private $tmp;
        private $image;
        private $image_text;
        private $type;
        private $uploadfile;
        private $target_file;
        private $imageFileType;
        private $user_id;
        private $post_id;
        private $location;
        private $lng;
        private $lat;
        private $filter_id;

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
            $this->target_file = $this->src . preg_replace("![^a-z0-9.]+!i", "_",basename($this->tmp["name"]));
            if(move_uploaded_file($this->tmp["tmp_name"], $this->target_file)){
                $query = "insert into posts (image, image_text, upload_time, user_id, lng, lat, filter_id) values (:image, :image_text, :upload_time, :user_id, :lng, :lat, :filter_id) ";
                $statement = $conn->prepare($query);
                $statement->bindValue(':image', $this->target_file);
                $statement->bindValue(':image_text', $this->image_text);
                $statement->bindValue(":user_id", $this->user_id);
                $statement->bindValue(':upload_time', date("Y-m-d H:i:s"));
                $statement->bindValue(":lat",$this->lat);
                $statement->bindValue(":lng",$this->lng);
                $statement->bindValue(":filter_id",$this->filter_id);
                var_dump($query);
                $res = $statement->execute();
                return $res;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        public function deletePost($id, $userid){
            $conn = Db::getInstance();
            $statement = $conn->prepare("DELETE FROM posts where id = :id and user_id = :user_id");
            $statement->bindParam(":id", $id);
            $statement->bindParam(":user_id", $userid);
            $result = $statement->execute();
            return $result;
        }

        // posts limit by 20 on the index page
        public static function getAll($words, $myuserid) {
            $conn = Db::getInstance();
            $limitposts = 20;
                $hashtags = array();
                
                $arrayLength = sizeof($words) - 1;
                for ($i = 0; $i <= $arrayLength; $i++) {
                        $hashtags[] = 'image_text LIKE "%'.htmlspecialchars($words[$i]["hashtag"]).'%"';
                    }


                    if($arrayLength <= 0){
                        $statement = $conn->prepare("select * from posts where user_id in (10,9,8, :user_id)" .implode(" OR ", $hashtags) . " ORDER BY upload_time DESC limit $limitposts");
                    } else {
                        $statement = $conn->prepare("select * from posts where user_id in (10,9,8, :user_id) OR " .implode(" OR ", $hashtags) . " ORDER BY upload_time DESC limit $limitposts");
                    }

        $statement->bindValue(":user_id", $myuserid);
            
            //AANGEZIEN FRIENDS NOG NIET GEMAAKT IS, HARD CODED FRIEND LIST OM CODE TE DOEN WERKEN
            
            $statement->execute();
            $result = $statement->fetchAll( PDO::FETCH_ASSOC );
            return $result;
        }

        public function getPostsByUser() {
                $conn = Db::getInstance();
        $statement = $conn->prepare("select * from posts where user_id = :user_id ORDER BY upload_time DESC");
                $statement->bindValue(":user_id", $this->user_id);
                $statement->execute();
                $result = $statement->fetchAll();
                return $result;
        }

        public function getMine() {
                $conn = Db::getInstance();
                $statement = $conn->prepare("select * from posts ORDER BY upload_time DESC where user_id = :user_id");
                $statement->bindValue(":user_id", $this->user_id);
                $statement->execute();
                $result = $statement->fetchAll( PDO::FETCH_ASSOC );
                return $result;
            }
        public function loadMore(){
        $conn  = Db::getInstance();
        $statement = $conn->prepare(" SELECT DISTINCT id, image, image_text, comment FROM posts  
        ORDER BY id DESC limit $no ,20");
        $statement->bindValue(":id",$_SESSION['id']);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
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
                $this->user_id = htmlspecialchars($user_id);

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
                $this->post_id = htmlspecialchars($post_id);

                return $this;
        }

        /**
         * Get the value of PictureLocation
         */ 
        public function getPictureLocation()
        {
                return $this->PictureLocation;
        }

        /**
         * Set the value of PictureLocation
         *
         * @return  self
         */ 
        public function setPictureLocation($PictureLocation)
        {
                $this->PictureLocation = $PictureLocation;

                return $this;
        }

        /**
         * Get the value of location
         */ 
        public function getLocation()
        {
                return $this->location;
        }

        /**
         * Set the value of location
         *
         * @return  self
         */ 
        public function setLocation($location)
        {
                $this->location = $location;

                return $this;
        }

        /**
         * Get the value of lng
         */ 
        public function getLng()
        {
                return $this->lng;
        }

        /**
         * Set the value of lng
         *
         * @return  self
         */ 
        public function setLng($lng)
        {
                $this->lng = $lng;

                return $this;
        }

        /**
         * Get the value of lat
         */ 
        public function getLat()
        {
                return $this->lat;
        }

        /**
         * Set the value of lat
         *
         * @return  self
         */ 
        public function setLat($lat)
        {
                $this->lat = $lat;

                return $this;
        }

        /**
         * Get the value of filter_id
         */ 
        public function getFilter_id()
        {
                return $this->filter_id;
        }

        /**
         * Set the value of filter_id
         *
         * @return  self
         */ 
        public function setFilter_id($filter_id)
        {
                $this->filter_id = $filter_id;

                return $this;
        }

        /**
         * Get the value of tmp
         */ 
        public function getTmp()
        {
                return $this->tmp;
        }

        /**
         * Set the value of tmp
         *
         * @return  self
         */ 
        public function setTmp($tmp)
        {
                $this->tmp = $tmp;

                return $this;
        }

        /**
         * Get the value of src
         */ 
        public function getSrc()
        {
                return $this->src;
        }

        /**
         * Set the value of src
         *
         * @return  self
         */ 
        public function setSrc($src)
        {
                $this->src = $src;

                return $this;
        }

        /**
         * Get the value of type
         */ 
        public function getType()
        {
                return $this->type;
        }

        /**
         * Set the value of type
         *
         * @return  self
         */ 
        public function setType($type)
        {
                $this->type = $type;

                return $this;
        }

        /**
         * Get the value of uploadfile
         */ 
        public function getUploadfile()
        {
                return $this->uploadfile;
        }

        /**
         * Set the value of uploadfile
         *
         * @return  self
         */ 
        public function setUploadfile($uploadfile)
        {
                $this->uploadfile = $uploadfile;

                return $this;
        }

        /**
         * Get the value of target_file
         */ 
        public function getTarget_file()
        {
                return $this->target_file;
        }

        /**
         * Set the value of target_file
         *
         * @return  self
         */ 
        public function setTarget_file($target_file)
        {
                $this->target_file = $target_file;

                return $this;
        }

        /**
         * Get the value of imageFileType
         */ 
        public function getImageFileType()
        {
                return $this->imageFileType;
        }

        /**
         * Set the value of imageFileType
         *
         * @return  self
         */ 
        public function setImageFileType($imageFileType)
        {
                $this->imageFileType = $imageFileType;

                return $this;
        }
    }