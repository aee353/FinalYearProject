<?php
require_once ('Model/map.php');
require_once("Model/userdataset.php");
require_once("Model/user.php");
$view = new stdClass();
//var_dump($_POST);
$view->pageTitle ='Map';
//$view->loginError = false;


$m = new map();
$user = new user();
$userdataset = new userdataset();
$identification = $user->userID();

$view->m = json_encode($m->fetchAllFriends($identification));

$view->userdataset = $userdataset->fetchAllUsersFriends($identification);
if(isset($_POST["acceptFriend"])){
    $userdataset = $userdataset->acceptFriend($identification);
    echo "Accepted";

}
require_once("logincontroller.php");

if ($user->isLoggedIn()){
    require_once("View/map.phtml");
}
else {
    //if user is not logged on they will not have access to the profile page and will automatically redirect to
    //home page so they can register.
    header("Location: http://localhost:8000/index.php");
    echo 'You must be logged on to access this page';

}
//$view->userdataset = $userdataset->fetchAllUsersFriends($user->userID());


//require_once("logincontroller.php");
//$view->m = json_encode($m->fetchAllHotels());

//$view->userdataset = $userdataset->fetchAllUsersFriends($user->userID());

//echo json_encode($m->fetchAllFriends($identification));
//echo $view->userdataset;

