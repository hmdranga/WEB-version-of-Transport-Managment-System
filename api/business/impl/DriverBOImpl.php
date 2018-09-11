<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 5:46 PM
 */
require_once __DIR__ . '/../DriverBO.php';
require_once __DIR__ . '/../../repository/impl/DriverRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class DriverBOImpl implements DriverBO{

    private $driverRepository;

    public function __construct()
    {
        $this->driverRepository = new DriverRepositoryImpl();
    }

    public function getDriversCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->driverRepository->setConnection($connection);

        $count =  count($this->driverRepository->findAllDrivers());

        mysqli_close($connection);

        return $count;
    }

    public function getAllDrivers()
    {
        $connection = (new DBConnection())->getConnection();
        $this->driverRepository->setConnection($connection);

        $drivers = $this->driverRepository->findAllDrivers();

        mysqli_close($connection);

        return $drivers;
    }

    public function deleteDriver($nic)
    {
        $connection = (new DBConnection())->getConnection();
        $this->driverRepository->setConnection($connection);

        $result = $this->driverRepository->deleteDriver($nic);

        mysqli_close($connection);

        return $result;
    }

    public function saveDriver($nic, $name, $address, $contactNo, $drivingLicenceNo)
    {
        $connection = (new DBConnection())->getConnection();
        $this->driverRepository->setConnection($connection);

        $driver = $this->driverRepository->saveDriver($nic, $name, $address, $contactNo, $drivingLicenceNo);

        mysqli_close($connection);

        return $driver;
    }

    public function updateDriver($nic, $name, $address, $contactNo, $drivingLicenceNo)
    {
        $connection = (new DBConnection())->getConnection();
        $this->driverRepository->setConnection($connection);

        $driver = $this->driverRepository->updateDriver($nic, $name, $address, $contactNo, $drivingLicenceNo);

        mysqli_close($connection);

        return $driver;

    }
}