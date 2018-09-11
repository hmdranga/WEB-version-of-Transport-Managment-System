<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/28/2018
 * Time: 10:18 PM
 */
require_once 'business/impl/ExpenceTypeBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$expenceTypeBO = new ExpenceTypeBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch ($action){
            case "count":
                echo json_encode($expenceTypeBO->getExpenceTypeCount());
                break;
            case "all":
                echo json_encode($expenceTypeBO->getAllExpenceType());
                break;
        }
        break;
    case "POST":
        $action = $_POST["action"];

        $type = $_POST["txtExpenceType"];

        switch ($action){
            case "save":
                echo json_encode($expenceTypeBO->saveExpenceType($exId, $type));
                break;
            case"update":
                echo json_encode($expenceTypeBO->updateExpenceType($exId, $type));
                break;
        }

        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/",$queryString);
        if (count($queryArray) === 2){
            $exId = $queryArray[1];
            echo json_encode($expenceTypeBO->deleteExpenceType($exId));
        }
        break;
}