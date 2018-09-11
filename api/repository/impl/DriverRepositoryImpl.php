<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 4:47 PM
 */
require_once __DIR__ . '/../DriverRepository.php';

class DriverRepositoryImpl implements DriverRepository{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveDriver($nic, $name, $address, $contactNo, $drivingLicenceNo)
    {
        $result = $this->connection->query("INSERT INTO driver VALUES ('{$nic}','{$name}','{$address}','{$contactNo}','{$drivingLicenceNo}')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateDriver($nic, $name, $address, $contactNo, $drivingLicenceNo)
    {
        $result = $this->connection->query("UPDATE driver SET  name='{$name}', address ='{$address}',contactNo ='{$contactNo}' WHERE nic='{$nic}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteDriver($nic)
    {
        $result = $this->connection->query("DELETE FROM driver WHERE nic='{$nic}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findDriver($nic)
    {
        $resultset = $this->connection->query("SELECT * FROM driver WHERE nic='{$nic}'");
        return $resultset->fetch_assoc();
    }

    public function findAllDrivers()
    {
        $resultset = $this->connection->query("SELECT * FROM driver");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}