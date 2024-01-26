<?php
require_once("Model/userdataset.php");
require_once("Model/user.php");
require_once("logincontroller.php");

$view = new stdClass();
$view->pageTitle = 'Homepage';

if(isset($_POST["signButton"])) {
    var_dump($_POST);
    $userdataset = new userdataset();

    //this line registers the form data into the table.
    $result = $userdataset->registerUser( "photo.jpg", $_POST["username"], $_POST["email"], $_POST["firstname"], $_POST["surname"], md5($_POST["password"]) );
   // $view->dbMessage = "$result";
}
require_once("View/index.phtml");