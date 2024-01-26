<?php
require_once ('Model/database.php');
require_once ('Model/userdata.php');
require_once('Model/hotel.php');
class userdataset
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllUsers( $p, $t)
    {
        $bind = $p . "," . $t;
        $sqlQuery = "SELECT * FROM users ORDER BY user_id LIMIT ?, ? ";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement (error)
       $statement->bindValue(1, (int)$p, PDO::PARAM_INT);
       $statement->bindValue(2, (int)$t, PDO::PARAM_INT);
        //$statement->bindParam(2, $t);
       $statement->execute(); // execute the PDO statement



        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userdata($row);
        }
        return $dataSet;
        //echo $dataSet;
    }

    public function registerUser($userimg, $username, $email, $firstname, $surname, $password)
    {
        $defaultlat = 53.483959;
        $defaultlong = -2.244644;
        $sql = "INSERT INTO users (user_image, user_username, user_email, user_firstname, user_surname, user_password, user_lat, user_long) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->_dbHandle->prepare($sql);

        $statement->bindParam(1, $userimg);
        $statement->bindParam(2, $username);
        $statement->bindParam(3, $email);
        $statement->bindParam(4, $firstname);
        $statement->bindParam(5, $surname);
        $statement->bindParam(6, $password);
        $statement->bindParam(7, $defaultlat);
        $statement->bindParam(8, $defaultlong);

        return $statement->execute();
    }

    public function checkUsersCredentials($usern, $userp)
    {
        $sql = ("SELECT * FROM users WHERE user_username  =?  AND user_password =? ");
        $statement = $this->_dbHandle->prepare($sql);

        $statement->bindParam(1, $usern);
        $statement->bindParam(2, $userp);

        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userdata($row);
        }
        return $dataSet;


    }

    public function checkCredentialsEncrypted($usern, $userp)
    {
       $encrypted =  md5($userp);
        $sql = ("SELECT * FROM users WHERE user_username  =?  AND user_password =? ");
        $statement = $this->_dbHandle->prepare($sql);

        $statement->bindParam(1, $usern);
        $statement->bindParam(2, $encrypted);

        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userdata($row);
        }
        return $dataSet;


    }

    public function sendMessage($users_id, $otheruser, $msg)
    {
        $sql = ("INSERT INTO message (outgoing_id, incoming_id, message) VALUES (?,?,?)");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $users_id);
        $statement->bindParam(2, $otheruser);
        $statement->bindParam(3, $msg);
        return $statement->execute();
    }

    public function getMessage($recieve)
    {
        $sql = ("SELECT * FROM message WHERE incoming_id = ?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $recieve);
        return $statement->execute();
    }

    public function updateLoggedIn($id)
    {
        $sql = ("UPDATE users set timestamp=now() WHERE user_id= ?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function getLastLoggedIn($id)
    {
        $sql = ("SELECT timestamp FROM users WHERE user_id=?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function getLoggedUser($id)
    {
        $sql = ("SELECT * FROM users WHERE user_id=?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    public function fetchSearch($searchText)
    {
        $sql = ("SELECT * FROM hotels WHERE hotel_Name LIKE '%$searchText%'  ORDER BY hotel_Name");
        //print json_encode($sql);
        //echo $sql;
        $statement = $this->_dbHandle->prepare($sql);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new hotel($row);
        }
        //echo $dataSet;
        return $dataSet;

    }

    public function getAllHotel()
    {
        $sql = ("SELECT * FROM hotels");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new hotel($row);
        }
        return $dataSet;
    }

    public function addHotel($hotel, $review, $rating)
    {
        $sql = ("INSERT INTO hotels (hotel_name, hotel_review, hotel_rating)  VALUES (?,?,?)");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $hotel);
        $statement->bindParam(2, $review);
        $statement->bindParam(3, $rating);
        return $statement->execute();

    }

    public function getUserStatus()
    {
        $sql = ("SELECT * FROM Friends WHERE status = 1 or 2");
        $statement = $this->_dbHandle->prepare($sql);
        return $statement->execute();
    }

    public function fetchAllUsersFriends($currentuser)
    {
        $sqlQuery = "select * from (
    select * from users
    where users.user_id in(
        select friend1 as friend
        from friend
        where (friend.friend1 = $currentuser or friend.friend2 = $currentuser)
        union
        select friend2 as friend
        from friend
        where (friend.friend1 = $currentuser or friend.friend2 = $currentuser)
        )
    and users.user_id != $currentuser
                  ) ping inner join friend where ((friend1=ping.user_id and friend2 = $currentuser) or (friend1=$currentuser and friend2=ping.user_id))";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new friends($row);
        }
        //echo $dataSet;
        return $dataSet;


    }
    public function updateUsername($x, $y)
    {
        $sql = ("UPDATE users  SET user_username=? WHERE user_id = ?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $x);
        $statement->bindParam(2, $y);
        return $statement->execute();
    }


    public function updateEmail($x, $y)
    {
        $sql = ("UPDATE users SET user_email=? WHERE user_id = ?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $x);
        $statement->bindParam(2, $y);
        return $statement->execute();
    }


    public function updatePassword($x, $y)
    {
        $sql = ("UPDATE users  SET user_password=? WHERE user_id = ?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $x);
        $statement->bindParam(2, $y);
        return $statement->execute();
    }

    public function addFriend($x, $y){
        $z = 1;
        $sql = ("INSERT INTO friend (friend1, friend2, status) VALUES (?, ?, ? )");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $x);
        $statement->bindParam(2, $y);
        $statement->bindParam(3, $z);
        return $statement->execute();
    }

    public function acceptFriend($x){
        $z = 2;
        $sql = ("UPDATE friend SET status = ? WHERE friend_id=?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $z);
        $statement->bindParam(1, $x);
        return $statement->execute();
    }

    public function deleteReview($x){
        $sql = ("DELETE FROM hotels WHERE hotelID=?");
        $statement = $this->_dbHandle->prepare($sql);
        $statement->bindParam(1, $x);
        return $statement->execute();
    }
}
