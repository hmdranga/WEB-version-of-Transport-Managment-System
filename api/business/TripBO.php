<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/26/2018
 * Time: 12:08 PM
 */

interface TripBO{
    public function getTripCount();

    public function getAllTrips();

    public function deleteTrip($id);

    public function saveTrip($id,$date,$start,$end,$regNo,$nic);

    public function updateTrip($id,$date,$start,$end,$regNo,$nic);

    public function getcountTotalKm( $sDate, $nic);
}

