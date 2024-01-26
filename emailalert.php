<?php
require_once ("Model/user.php");
require_once ("Model/userdata.php");
require_once ("Model/userdataset.php");
$user = new user();
$userdata = new userdataset();
$time = $userdata->getLastLoggedIn($user->userID());
$lasttime = time()-strtotime($time);
#variables to send to the users email once they click a button to start alerts
if(isset($_POST["emailbutton"] ) && $lasttime > 20000) {
    //$to = $userEmail->getEmail();
    ini_set("sendmail_from", "a.ahmad13@edu.salford.ac.uk");
    $cc = ($_POST["chosenemail"]);
    $subject = 'Security alert';
    $message = 'This user has activated their security feature. 18 hours of inactivity detected. Please login, or contact user to login.';
    $header = "From:a.ahmad13@edu.salford.ac.uk\r\n";
    if(mail($cc, $subject, $message, $header)){
        echo " Email Sent ";
    }
}
else if(isset($_POST["emailbutton"] ) && $lasttime >10000 && $lasttime <20000)
    {
        $cc = ($_POST["chosenemail"]);
        //$to = $userEmail->getEmail();
        $subject = 'Security alert disabled';
        $message = 'You have logged in within the required time therefore the security email has been disabled.';
        $header = "From:a.ahmad13@edu.salford.ac.uk\r\n";
        mail($cc, $subject, $message, $header);
}