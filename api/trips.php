<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/26/2018
 * Time: 9:55 AM
 */
require_once 'business/impl/TripBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$tripBO = new TripBOImpl();

switch ($method) {
    case "GET":
        $action = $_GET["action"];

        switch ($action) {
            case "count":
                echo json_encode($tripBO->getTripCount());
                break;
            case "all":
                echo json_encode($tripBO->getAllTrips());
                break;

        }
        break;

    case "POST":
        $action = $_POST["action"];
        $id = $_POST["txtTripID"];
        $date = $_POST["txtTripDate"];
        $start = $_POST["txtStartKm"];
        $end = $_POST["txtEndKm"];
        $regNo = $_POST["cmbRegNo"];
        $nic = $_POST["cmbDNIC"];


        switch ($action) {
            case "save":
                echo json_encode($tripBO->saveTrip($id ,$date, $start, $end, $regNo, $nic));
                break;
            case "update":
                echo json_encode($tripBO->updateTrip($id, $date, $start, $end, $regNo, $nic));
                break;

        }

        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/", $queryString);
        if (count($queryArray) === 2) {
            $id = $queryArray[1];
            echo json_encode($tripBO->deleteTrip($id));
        }
        break;
}