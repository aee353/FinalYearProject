<?php
class Hash{
 protected $id, $normpassword;
    public function __construct($dbrows){
        $this->userID = $dbrows['user_id'];
        $this->password = $dbrows['user_password'];


    }


}