<?php
require_once ('Model/database.php');
class hotel
{
    protected $hID, $hotel, $review, $rating, $long, $lat, $_lat;

    public function __construct($dbrows){
        $this->hID = $dbrows['hotelID'];
        $this->hotel = $dbrows['hotel_name'];
        $this->review = $dbrows['hotel_review'];
        $this->rating = $dbrows['hotel_rating'];
        $this->lat = $dbrows['hotel_lat'];
        $this->long = $dbrows['hotel_long'];
    }

    /**
     * @return mixed
     */
    public function getHID(): mixed
    {
        return $this->hID;
    }

    /**
     * @return mixed
     */
    public function getHotel(): mixed
    {
        return $this->hotel;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getReview(): mixed
    {
        return $this->review;
    }
    public function getRating(): mixed
    {
        return $this->rating;
    }

    /**
     * @return mixed
     */
    public function getLat(): mixed
    {
        return $this->lat;
    }

    /**
     * @return mixed
     */
    public function getLong(): mixed
    {
        return $this->long;
    }

    public function setHotel($setHotel){
        $this->hotel = $setHotel;
        return $this->hotel;
    }
    public function setRating($setRating){
        $this->rating = $setRaing;
        return $this->rating;
    }
    public function setReview($setReview){
        $this->review = $setReview;
        return $this->review;
    }
}