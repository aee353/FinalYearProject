<?php
require_once('Model/hotel.php');
require_once('Model/database.php');

class liveSearch
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()

    {
        $this->_dbInstance = database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    //database extraction sql specifically for live search results
    public function liveHotels($live)
    {
        // adds the % to the variable
        $bind = $live . '%';

        $sql = ("SELECT * FROM hotels WHERE hotel_Name LIKE ? ORDER BY hotelID ");
        $statement = $this->_dbHandle->prepare($sql);
        //echo $sql;

        $statement->bindParam(1, $bind);
        $statement->execute();

        $dataSet = [];
        // creates an array to pass onto script code
        while ($row = $statement->fetch())
        {
            $jsonDataSet = new hotel($row);

            $jsonDataSet = array (
                //'userID' => $jsonDataSet->getUserID(),
                //'username' => $jsonDataSet->getUsername(),
                'hotelName' => $jsonDataSet->getHotel(),

            );


            $dataSet[] = $jsonDataSet;
        }
        echo json_encode($dataSet);
        return $dataSet;
    }

}