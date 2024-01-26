<?php
require_once("Model/user.php");
require_once("logincontroller.php");

$view = new stdClass();
$view->pageTitle = 'Contact Us';

require_once("View/contact.phtml");