<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/25/2018
 * Time: 4:36 PM
 */

require_once 'business/impl/VehicleBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$vehicleBO = new VehicleBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch($action){
            case "count":
                echo json_encode($vehicleBO->getVehiclesCount());
                break;
            case "all":
                echo json_encode($vehicleBO->getAllVehicles());
                break;
        }

        break;
    case "POST":
        $action = $_POST["action"];
        $vregNo = $_POST["txtRegNo"];
        $vbrand = $_POST["txtBrand"];
        $vcolor = $_POST["color"];
        $vboughtdate = $_POST["txtDate"];

        switch ($action){
            case "save":
                echo json_encode($vehicleBO->saveVehicle($vregNo,$vbrand,$vcolor,$vboughtdate));
                break;
            case"update":
                echo json_encode($vehicleBO->updateVehicle($vregNo,$vbrand,$vcolor,$vboughtdate));
                break;
        }

        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/",$queryString);
        if (count($queryArray) === 2){
            $vregNo = $queryArray[1];
            echo json_encode($vehicleBO->deleteVehicle($vregNo));
        }
        break;
}