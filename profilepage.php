<?php
require_once("Model/user.php");
require_once("Model/userdataset.php");
$data = new userdataset();
$user = new user();

$view = new stdClass();
$view->pageTitle = 'Your profile page';
$view->profile = $data->getLoggedUser($user->userID());

echo json_encode($data);

if(isset($_POST["submit"])){
    $file = 'uploads/';
    $og_file = $_FILES['image']['tmp_name'];
    $file_target = $file . basename($_FILES['image']['name']);
    move_uploaded_file($og_file,$file_target);
}

if(isset($_POST["submitnewUsername"])){
    $data = $data->updateUsername($_POST["newUsername"], $user->userID());
}
if (isset($_POST["submitnewemail"])){
    $data = $data->updateEmail( $_POST["newEmail"], $user->userID());
}
if(isset($_POST["submitnewPassword"])){
    $data = $data->updatePassword(md5( $_POST["newPass"]), $user->userID());
}




if ($user->isLoggedIn()){
    require_once("View/profilepage.phtml");
}
else {
    //if user is not logged on they will not have access to the profile page and will automatically redirect to
    //home page so they can register.
   header("Location: http://localhost:8000/index.php");
    echo 'You must be logged on to access this page';

}

