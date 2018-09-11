<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 4:36 PM
 */

interface DriverRepository{
    public function setConnection(mysqli $connection);

    public function saveDriver($nic,$name,$address,$contactNo,$drivingLicenceNo);

    public function updateDriver($nic,$name,$address,$contactNo,$drivingLicenceNo);

    public function deleteDriver($nic);

    public function findDriver($nic);

    public function findAllDrivers();
}