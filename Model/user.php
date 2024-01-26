<?php
require_once ('Model/database.php');

class user
{
    protected $_username, $_loggedin, $_userID;

    public function __construct()
    {
        session_start();

        $this->_username="No user";
        $this->_loggedin= false;
        $this->_userID= '0';

        if (isset($_SESSION["login"]))
        {
            $this->_username = $_SESSION["login"];
            $this->_userID = $_SESSION["uid"];
            $this->_loggedin = true;
        }
    }

    public function initialise()
    {

        $this->_loggedin= false;
        $this->_userID= "0";
    }


    public function Authenticate($usern, $userp)
    {
        //$encrypt = md5($userp);
        $user = new userdataset();
        $userdatasets = $user->checkUsersCredentials($usern,$userp);

        if(count($userdatasets) > 0)
        {
            $_SESSION["login"] = $usern;
            $_SESSION["uid"] = $userdatasets[0]->getUserID();
            $this->_loggedin= true;
            $this->_username= $usern;
            $this->_userID= $userdatasets[0]->getUserID();
            return true;
        }
        else
        {
            $this->_loggedin= false;
            return false;
        }
    }

    public function AuthenticateEncrypt($usern, $userp)
    {
        $encrypt = md5($userp);
        $user = new userdataset();
        $userdatasets = $user->checkUsersCredentials($usern,$encrypt);

        if (count($userdatasets) > 0)
        {
            $_SESSION["login"] = $usern;
            $_SESSION["uid"] = $userdatasets[0]->getUserID();
            $this->_loggedin= true;
            $this->_username= $usern;
            $this->_userID= $userdatasets[0]->getUserID();
            return true;
        }
        else
        {
            $this->_loggedin= false;
            return false;
        }
    }

    public function isLoggedIn()
    {
        return $this->_loggedin;

    }

    /**
     * @return mixed|string
     */
    public function userID()
    {
        return $this->_userID;
    }




}