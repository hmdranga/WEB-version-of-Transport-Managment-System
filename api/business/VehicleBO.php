<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/23/2018
 * Time: 4:36 PM
 */

interface VehicleBO
{

    public function getVehiclesCount();

    public function getAllVehicles();

    public function deleteVehicle($vregNo);

    public function saveVehicle($vregNo,$vbrand,$vcolor,$vboughtdate);

    public function updateVehicle($vregNo, $vbrand, $vcolor, $vboughtdate);

}