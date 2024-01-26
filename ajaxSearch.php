<?php
require_once("Model/liveSearch.php");
$view = new stdClass();
$token = "";
if (isset($_REQUEST["q"])){
    $data = new liveSearch();
    $result = $data->liveHotels($_REQUEST["q"]);
    echo json_encode($result);
}