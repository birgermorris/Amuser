<?php 
    Class Posts {
        public $src = "data/post/";
        public $tmp;
        public $filename;
        public $type;
        public $uploadfile;
        public $target_file;
        public $imageFileType;

        public function PhotoCheck(){
            // Check if image file is a actual image or fake image
            $check = getimagesize($this->tmp["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($this->tmp["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            
            $filename = $_FILES['image']['name'];
            $tmp = explode('.',$filename);
            $imageFileType = end($tmp);

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        }
        public function PhotoUpload(){
            $this->target_file  = $this->src. basename($this->tmp["name"]);
            if(move_uploaded_file($this->tmp["tmp_name"], $this->target_file)){
                echo "The file ".basename( $this->tmp["name"])." has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
    }
?>