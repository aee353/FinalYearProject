<?php
require_once("Model/userdataset.php");
require_once("Model/user.php");

$view = new stdClass();
$view->pageTitle = 'Messaging';

$user = new user();
if(isset($_POST["sndmessage"])) {
    var_dump($_POST);
    $userdataset = new userdataset();
    $send = $userdataset->sendMessage($user->userID(),  $_POST['incoming_id'],  $_POST['message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $user = $user->userID();
}
////$return = $m->getMessage($user);
//echo json_encode($return);

require_once("View/messaging.phtml");