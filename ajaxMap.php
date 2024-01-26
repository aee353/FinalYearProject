<?php
require_once("Model/map.php");
require_once("Model/user.php");
$m = new map();
$user = new user();

$return = "";
$h = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user = $user->userID();


}
$return = $m->fetchAllFriends($user);
$h = $m->fetchAllHotels();
echo json_encode($return);
