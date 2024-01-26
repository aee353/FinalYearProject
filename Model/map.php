<?php
require_once ('Model/hotel.php');
require_once ('Model/friends.php');
require_once ('Model/userdata.php');

class map
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllHotels()
    {

        $sql = ("SELECT * FROM hotels ");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $data = new hotel($row);
            $hotelData = array(
                'HID' => $data->getHID(),
                'hotelName' => $data->getHotel(),
                'review' => $data->getReview(),
                'rating' => $data->getRating(),
                'latitude' => $data->getLat(),
                'longitude' => $data->getLong()

            );
            $dataSet[] = $hotelData;
        }
        return $dataSet;

    }

    public function fetchAllFriends($currentuser)
    {
        $bind = $currentuser . '%';
        $sqlQuery = "select * from (
    select * from users
    where users.user_id in(
        select friend1 as friend
        from friend
        where (friend.friend1 = ? or friend.friend2 = ?)
        union
        select friend2 as friend
        from friend
        where (friend.friend1 = ? or friend.friend2 = ?)
        )
    and users.user_id != ?
                  ) ping inner join friend where ((friend1=ping.user_id and friend2 = ?) or (friend1=? and friend2=ping.user_id))";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1, $bind);
        $statement->bindParam(2, $bind);
        $statement->bindParam(3, $bind);
        $statement->bindParam(4, $bind);
        $statement->bindParam(5, $bind);
        $statement->bindParam(6, $bind);
        $statement->bindParam(7, $bind);

        $statement->execute();
        //echo json_encode($statement);

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $data = new friends($row);
            $mapData = array(
                'userID' => $data->getUID(),
                'username' => $data->getFriendUsername(),
                'firstName' => $data->getFirstName(),
                'lastName' => $data->getLastName(),
                'longitude' => $data->getLong(),
                'latitude' => $data->getLat()
            );
            $dataSet[] = $mapData;
        }

        return $dataSet;
        //echo json_encode($dataSet);

    }
}