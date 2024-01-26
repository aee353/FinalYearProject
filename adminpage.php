<?php
require_once("Model/userdataset.php");
require_once("Model/user.php");
require_once("Model/hotel.php");
$user = new user();

$view = new stdClass();
$view->pageTitle = 'admin';
$hotel = new userdataset();

$view->search = $hotel->getAllHotel();

if(isset($_POST["deleteUser"])) {
    $ID =$_POST["hiddenHID"];
    $delete = $hotel->deleteReview($ID);
    echo 'deleted';
}
if(isset($_POST["sendreview"])) {
    var_dump($_POST);
    $userdataset = new userdataset();

    //this line registers the form data into the table.
    $result = $userdataset->addHotel( $_POST["hotel"], $_POST["review"], $_POST["rating"] );
    $view->dbMessage = "$result";
}
require_once("View/admin.phtml");