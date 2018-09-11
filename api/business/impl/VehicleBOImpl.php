<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 4:36 PM
 */

require_once __DIR__ . '/../VehicleBO.php';
require_once __DIR__ . '/../../repository/impl/VehicleRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class VehicleBOImpl implements VehicleBO
{

    private $vehicleRepository;

    public function __construct()
    {
        $this->vehicleRepository = new VehicleRepositoryImpl();
    }

    public function getVehiclesCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $count =  count($this->vehicleRepository->findAllVehicles());

        mysqli_close($connection);

        return $count;
    }

    public function getAllVehicles()
    {
        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $vehicles = $this->vehicleRepository->findAllVehicles();

        mysqli_close($connection);

        return $vehicles;
    }

    public function deleteVehicle($vregNo)
    {
        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $result = $this->vehicleRepository->deleteVehicle($vregNo);

        mysqli_close($connection);

        return $result;
    }

    public function saveVehicle($vregNo, $vbrand, $vcolor, $vboughtdate)
    {
        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $vehicle = $this->vehicleRepository->saveVehicle($vregNo, $vbrand, $vcolor, $vboughtdate);

        mysqli_close($connection);

        return $vehicle;
    }

    public function updateVehicle($vregNo, $vbrand, $vcolor, $vboughtdate)
    {
        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $vehicle = $this->vehicleRepository->updateVehicle($vregNo, $vbrand, $vcolor, $vboughtdate);

        mysqli_close($connection);

        return $vehicle;

    }
}