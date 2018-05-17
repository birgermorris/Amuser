<?php 
include_once("db.class.php");
    Class Filter {
        private $filter_number;

        /**
         * Get the value of filter_number
         */ 
        public function getFilter_number()
        {
                return $this->filter_number;
        }

        /**
         * Set the value of filter_number
         *
         * @return  self
         */ 
        public function setFilter_number($filter_number)
        {
                $this->filter_number = $filter_number;

                return $this;
        }

        public function getFilters() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("Select * FROM filters");
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
    }

?>