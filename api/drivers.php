<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 7:25 PM
 */
require_once 'business/impl/DriverBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$driverBO = new DriverBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch ($action){
            case "count":
                echo json_encode($driverBO->getDriversCount());
                break;
            case "all":
                echo json_encode($driverBO->getAllDrivers());
                break;
        }
        break;
    case "POST":
        $action = $_POST["action"];
        $nic = $_POST["txtNic"];
        $name = $_POST["txtDName"];
        $address = $_POST["txtAddress"];
        $contactNo = $_POST["txtContactNo"];
        $drivingLicenceNo = $_POST["txtDLN"];

        switch ($action){
            case "save":
                echo json_encode($driverBO->saveDriver($nic,$name,$address,$contactNo,$drivingLicenceNo));
                break;
            case"update":
                echo json_encode($driverBO->updateDriver($nic,$name,$address,$contactNo,$drivingLicenceNo));
                break;
        }

        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/",$queryString);
        if (count($queryArray) === 2){
            $nic = $queryArray[1];
            echo json_encode($driverBO->deleteDriver($nic));
        }
        break;
}