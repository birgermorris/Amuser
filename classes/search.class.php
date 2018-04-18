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
}

?>