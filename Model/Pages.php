<?php
require_once ('Model/database.php');

class Pages
{
    protected $noOfPages, $allPages, $page, $totalPages, $store;
   protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();

        $sql = "SELECT COUNT(*) FROM users";
        $statement = $this->_dbHandle->prepare($sql);
        $statement->execute();

        $this->noOfPages = 22;
        $totalPages =  $statement->fetchColumn(0);
        $this->totalPages = $totalPages;

        //formula to determine total number of pages
        $this->allPages = ceil($totalPages / $this->noOfPages);

        if(!isset($_GET['page'])){
            $this->page = 1;
        }
        else {
            $this->page = $_GET['page'];
        }

        $this->store = ($this->page - 1) * $this->noOfPages;
        echo $this->store;


    }



    public function setHotelPage(){
        
    }

    public function getnoOfPages(){
        return $this->noOfPages;
    }

    public function getPage(){
        return $this->page;
    }

    public function getTotalPages(){
        return $this->totalPages;
    }

    public function getAllPages(){
        return $this->allPages;
    }

    public function getStore(){
        return $this->store;
    }

}