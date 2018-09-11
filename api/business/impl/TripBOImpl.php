<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/26/2018
 * Time: 12:52 PM
 */

require_once __DIR__ . '/../TripBO.php';
require_once __DIR__ . '/../../repository/impl/TripRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class TripBOImpl implements TripBO{

    private $tripRepository;
    public function __construct()
    {
        $this->tripRepository = new TripRepositoryImpl();
    }

    public function getTripCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->tripRepository->setConnection($connection);

        $count = count($this->tripRepository->findAllTrips());
        mysqli_close($connection);
        return $count;
    }

    public function getAllTrips()
    {
        $connection = (new DBConnection())->getConnection();
        $this->tripRepository->setConnection($connection);

        $trips = $this->tripRepository->findAllTrips();
        mysqli_close($connection);
        return $trips;
    }

    public function deleteTrip($id)
    {
        $connection = (new DBConnection())->getConnection();
        $this->tripRepository->setConnection($connection);

        $trip = $this->tripRepository->deleteTrip($id);

        mysqli_close($connection);

        return $trip;
    }

    public function saveTrip($id,$date, $start, $end, $regNo, $nic)
    {
        $connection = (new DBConnection())->getConnection();
        $this->tripRepository->setConnection($connection);

        $trip = $this->tripRepository->saveTrip($id, $date, $start, $end, $regNo, $nic);

        mysqli_close($connection);

        return $trip;
    }

    public function updateTrip($id, $date, $start, $end, $regNo, $nic)
    {
        $connection = (new DBConnection())->getConnection();
        $this->tripRepository->setConnection($connection);

        $trip = $this->tripRepository->updateTrip($id, $date, $start, $end, $regNo, $nic);

        mysqli_close($connection);

        return $trip;

    }


    public function getcountTotalKm( $sDate, $nic)
    {
        $connection = (new DBConnection())->getConnection();
        $this->tripRepository->setConnection($connection);

        $totalKm = $this->tripRepository->countTotalKm($sDate, $nic);

        mysqli_close($connection);

        return $totalKm;
    }
}