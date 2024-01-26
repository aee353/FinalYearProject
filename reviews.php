<?php
require_once("Model/userdataset.php");
require_once("Model/user.php");
$user = new user();

$view = new stdClass();
$view->pageTitle = 'Reviews';
$hotel = new userdataset();

$view->search = $hotel->getAllHotel();

if(isset($_POST["sendreview"])) {
    var_dump($_POST);
    $userdataset = new userdataset();

    //this line registers the form data into the table.
    $result = $userdataset->addHotel( $_POST["hotel"], $_POST["review"], $_POST["rating"] );
    $view->dbMessage = "$result";
}

if ($user->isLoggedIn()) {
    require_once("View/reviews.phtml");
}
else {
    //if user is not logged on they will not have access to the profile page and will automatically redirect to
    //home page so they can register.
    header("Location: http://localhost:8000/index.php");
    echo 'You must be logged on to access this page';

}

