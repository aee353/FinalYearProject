<?php
require_once ('Model/userdataset.php');
require_once ('Model/liveSearch.php');

$view = new stdClass();
$view->pageTitle ='Search';


$search = new userdataset();
$liveSearch = new liveSearch();


if (isset($_POST["searchBox"])) {
    //$searchTerm = $_POST["searchBox"];
    //$result = $search->fetchSearch($searchTerm);
    $view->search = $search->fetchSearch($_POST["searchBox"]);
    $view->liveSearch = json_encode($liveSearch->liveHotels($_POST["searchBox"]));



    //echo 'is it working ' . $search;

}

require_once ('View/reviews.phtml');