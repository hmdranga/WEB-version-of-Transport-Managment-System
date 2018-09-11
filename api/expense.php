<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 5:57 AM
 */
require_once 'business/impl/ExpenseBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$expenseBO = new ExpenseBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch ($action){
            case "count":
                echo json_encode($expenseBO->getExpensesCount());
                break;
            case "all":
                echo json_encode($expenseBO->getAllExpenses());
                break;
        }
        break;


    case "POST":
        $action = $_POST["action"];
        $vregNo = $_POST["txtRegNo"];
        $exId = $_POST["txtExId"];
        $exDate = $_POST["txtExDate"];
        $amount = $_POST["txtAmount"];
        $description = $_POST["txtDescription"];

        switch ($action){
            case "save":
                echo json_encode($expenseBO->saveExpense($vregNo, $exId, $exDate, $amount, $description));
                break;
            case"update":
                echo json_encode($expenseBO->updateExpense($vregNo, $exId, $exDate, $amount, $description));
                break;
        }

        break;
    case "DELETE":
        echo "i am delete";
        $queryString = $_SERVER["QUERY_STRING"];

        echo $queryString;
        $queryArray = preg_split("/&/",$queryString);


        if (count($queryArray) === 2){/////////////////////////////////
            $reg1 = $queryArray[0];
            $exId1 = $queryArray[1];////////////////////////////////////
            $queryArray1 = preg_split("/=/",$reg1);
            echo $queryArray1;
            $queryArray2 = preg_split("/=/",$exId1);
            echo $queryArray2;

            if (count($queryArray1) === 2){
                $vregNo = $queryArray[1];
            }
           else if (count($queryArray2) === 2){
               $exId = $queryArray[1];
            }
            echo json_encode($expenseBO->deleteExpense($vregNo, $exId));
        }
        break;
}