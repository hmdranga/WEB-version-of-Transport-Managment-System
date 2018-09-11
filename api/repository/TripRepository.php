<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/26/2018
 * Time: 10:01 AM
 */
interface TripRepository{
    public function setConnection(mysqli $connection);

    public function saveTrip($id,$date,$start,$end,$regNo,$nic);

    public function updateTrip($id,$date,$start,$end,$regNo,$nic);

    public function deleteTrip($id);

    public function findTrip($id);

    public function findAllTrips();

    public function countTotalKm( $sDate, $nic);
}