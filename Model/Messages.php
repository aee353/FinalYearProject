<?php

class Messages extends userdata
{

    protected $msgid, $outgoing, $incoming, $msg, $_userID, $_usernames, $_userImage;

    public function __construct($dbrows)
    {
        $this->_userID = $dbrows['user_id'];
        $this->_usernames = $dbrows['user_username'];
        $this->_userImage = $dbrows['user_image'];
        $this->msgid = $dbrows['message_id'];
        $this->outgoing = $dbrows['outgoing_id'];
        $this->incoming = $dbrows['incoming_id'];
        $this->msg = $dbrows['message'];

    }

    public function getUserID()
    {
        return $this->_userID;
    }
    public function getUserImage()
    {
        return $this->_userImage;
    }

    public function getUsername()
    {
        return $this->_usernames;
    }

    public function getMessageid()
    {
        return $this->msgid;
    }
    public function getOutgoing()
    {
        return $this->outgoing;
    }
    public function getIncoming()
    {
        return $this->incoming;
    }

    public function getMessage()
    {
        return $this->msg;
    }




}