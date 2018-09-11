<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/22/2018
 * Time: 4:36 PM
 */

interface VehicleRepository
{

    public function setConnection(mysqli $connection);

    public function saveVehicle($vregNo,$vbrand,$vcolor,$vboughtdate);

    public function updateVehicle($vregNo,$vbrand,$vcolor,$vboughtdate);

    public function deleteVehicle($vregNo);

    public function findVehicle($vregNo);

    public function findAllVehicles();

}