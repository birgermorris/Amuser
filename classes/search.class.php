<?php
include_once("db.class.php");

Class Search {
    private $searchText;

    /**
     * Get the value of searchText
     */ 
    public function getSearchText()
    {
        return $this->searchText;
    }

    /**
     * Set the value of searchText
     *
     * @return  self
     */ 
    public function setSearchText($searchText)
    {
        $this->searchText = $searchText;

        return $this;
    }

    public function search() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from posts where image_text like :text");
        $statement->bindValue(':text', "%".$this->searchText."%");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function searchLocation($lat, $lng) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT *, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
        cos( radians( lng ) - radians(:lng) ) + sin( radians(:lat) ) * 
        sin( radians( lat ) ) ) ) AS distance FROM posts HAVING
        distance < 3 ORDER BY distance /*LIMIT 0 , 20*/;");
        $statement->bindValue('lat', $lat);
        $statement->bindValue('lng', $lng);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}

?>