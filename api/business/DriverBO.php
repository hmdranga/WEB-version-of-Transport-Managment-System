<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 5:36 PM
 */
interface DriverBO{
    public function getDriversCount();

    public function getAllDrivers();

    public function deleteDriver($nic);

    public function saveDriver($nic,$name,$address,$contactNo,$drivingLicenceNo);

    public function updateDriver($nic,$name,$address,$contactNo,$drivingLicenceNo);
}


