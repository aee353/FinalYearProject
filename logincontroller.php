<?php

require_once('Model/database.php');
require_once('Model/userdataset.php');
require_once('Model/user.php');

//session_start();

$user = new user();
$data = new userdataset();

var_dump($_SESSION);

if (isset($_POST["loginbutton"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //echo $username;
    //echo $password;

//$username = 'a' && $password = 'b'

    if ($user->Authenticate($username, $password)) {
        // better would be to check these variables against your database

        $check[] = ('SELECT user_username, user_password FROM users WHERE user_username=$username AND user_password=$password');
        //$check = "SELECT users_Username, users_Password FROM Users WHERE users_Username=$username AND users_Password=$password";

        // if number of rows returned > 0 then the username and password matched
        if (count($check) < 1) {


            echo "You are logged in";
            $_SESSION["login"] = $username;
            $data->updateLoggedIn($user->userID());
        }
    }
    else if ($user->AuthenticateEncrypt($username, $password)) {
        $check[] = ('SELECT user_username, user_password FROM users WHERE user_username=$username AND user_password=$password');
        if (count($check) < 1) {


            echo "You are logged in";
            $_SESSION["login"] = $username;
            $data->updateLoggedIn($user->userID());
        }
    }
    else {
        echo "Error in username and password";

    }


}
if (isset($_POST["logoutbutton"])) {
    echo "logout user";
    unset($_SESSION["login"]);
    session_destroy();
}

