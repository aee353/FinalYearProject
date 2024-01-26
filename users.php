<?php
require_once("Model/userdataset.php");
require_once("Model/user.php");
require_once("Model/Pages.php");
require_once("Model/user.php");
$view = new stdClass();
$view->pageTitle = 'All users';
$pages = new Pages();
$user = new user();
//$userdata = new userdata();

$userdataset = new userdataset();
$view->usersPage = $userdataset->fetchAllUsers( $pages->getStore(), $pages->getTotalPages());
$view->numberOfPages = $pages->getnoOfPages();

if(isset($_POST["addFriend"])){
    $friend2 =  $_POST["hiddenFriendID"];
    $friend1 = $user->userID();
    $userdataset = $userdataset->addFriend($friend1,$friend2);
    echo "Request sent....";
}
if ($user->isLoggedIn()){
    require_once("View/allusers.phtml");
}
else {
    //if user is not logged on they will not have access to the profile page and will automatically redirect to
    //home page so they can register.
    header("Location: http://localhost:8000/index.php");
    echo 'You must be logged on to access this page';

}
