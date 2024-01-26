<?php
require_once ('Model/database.php');

class userdata
{
    protected $_userID, $_userImage, $_usernames, $_email, $_firstname, $_surname, $_lat, $_long , $_password;

    public function __construct($dbrows)
    {
        $this->_userID = $dbrows['user_id'];
        $this->_userImage = $dbrows['user_image'];
        $this->_usernames = $dbrows['user_username'];
        $this->_email = $dbrows['user_email'];
        $this->_firstname = $dbrows['user_firstname'];
        $this->_surname = $dbrows['user_surname'];
        //$this->_lat = $dbrows['users_Friends'];
        $this->_password = $dbrows['user_password'];
        $this->_lat = $dbrows['user_lat'];
        $this->_long = $dbrows['user_long'];
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->_userID;
    }

    public function getUserImage()
    {
        return $this->_userImage;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_usernames;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->_surname;
    }


    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->_lat;
    }
    public function getLong()
    {
        return $this->_long;
    }

    public function getPassword()
    {
        return $this->_password;
    }


}