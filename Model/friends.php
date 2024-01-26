<?php
require_once ('Model/userdata.php');

class friends extends userdata
{
    protected $_friendsID, $_friend1, $_friend2, $_status, $_usernames, $_firstName, $_lastName, $_lat, $_long, $userID;

    public function __construct($dbrows)
    {
        $this->userID = $dbrows['user_id'];
        $this->_usernames = $dbrows['user_username'];
        $this->_friendsID = $dbrows['friend_id'];
        $this->_friend1 = $dbrows['friend1'];
        $this->_friend2 = $dbrows['friend2'];
        $this->_status = $dbrows['status'];
        $this->_firstName = $dbrows['user_firstname'];
        $this->_lastName = $dbrows['user_surname'];
        $this->_long = $dbrows['user_long'];
        $this->_lat = $dbrows['user_lat'];


    }

    public function getFriendUsername()
    {
        return $this->_usernames;
    }

    public function getUID()
    {
        return $this->userID;
    }


    public function getFriendID()
    {
        return $this->_friendsID;
    }

    public function getFriend1()
    {
        return $this->_friend1;
    }

    public function getFriend2()
    {
        return $this->_friend2;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function getLat()
    {
        return $this->_lat;
    }

    public function getLong()
    {
        return $this->_long;
    }


}