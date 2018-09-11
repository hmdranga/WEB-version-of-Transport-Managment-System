<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 10:41 AM
 */
require_once 'business/impl/TripBOImpl.php';
require_once 'business/impl/SalaryBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$salaryBO = new SalaryBOImpl();
$tripBO = new TripBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch ($action){
            case "count":
                echo json_encode($salaryBO->getSalariesCount());
                break;
            case "all":
                echo json_encode($salaryBO->getAllSalaries());
                break;
            case "countKm":
                $sDate = 2018-01-01;//$_GET["txtFromDate"];
                $nic = "854967123V";//$_GET["cmbDNIC"];
                echo json_encode($tripBO->getcountTotalKm($sDate,$nic));
                break;

        }
        break;
    case "POST":


        $action = $_POST["action"];
        $sId = $_POST["txtSalaryID"];
        $sDate =$_POST["txtFromDate"];//2018-02-12; //
        $totalKm = $_POST["totalkm"];
        $bonus = $_POST["txtBonus"];
        $amountPerKm = $_POST["txtAmountPerKm"];
        $earn = $_POST["earn"];
        $total = $_POST["txtTotal"];
        $nic = $_POST["cmbDNIC"];//"854967123V";


        switch ($action){
            case "save":
                echo json_encode($salaryBO->saveSalary($sId, $sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic));
                break;
            case"update":
                echo json_encode($salaryBO->updateSalary($sId, $sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic));
                break;

        }
        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/",$queryString);
        if (count($queryArray) === 2){
            $sId= $queryArray[1];
            echo json_encode($salaryBO->deleteSalary($sId));
        }
        break;
}