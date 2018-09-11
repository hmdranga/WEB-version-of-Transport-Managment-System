<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 6:29 AM
 */
require_once __DIR__.'/../ExpenseRepository.php';

class ExpenseRepositoryImpl implements ExpenseRepository{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveExpense($vregNo, $exId, $exDate, $amount, $description)
    {
        $result = $this->connection->query("INSERT INTO expencedetail VALUES ('{$vregNo}','{$exId}','{$exDate}','{$amount}','{$description}')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateExpense($vregNo, $exId, $exDate, $amount, $description)
    {
        $result = $this->connection->query("UPDATE expencedetail SET  date='{$exDate}', amount ='{$amount}',description ='{$description}' WHERE regNo='{$vregNo}' && exId='{$exId}' ");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteExpense($vregNo, $exId)
    {
        $result = $this->connection->query("DELETE FROM expencedetail WHERE regNo='{$vregNo}' && exId='{$exId}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findExpense($vregNo, $exId)
    {
        $resultset = $this->connection->query("SELECT * FROM expencedetail WHERE regNo='{$vregNo}' && exId='{$exId}'");
        return $resultset->fetch_assoc();
    }

    public function findAllExpenses()
    {
        $resultset = $this->connection->query("SELECT * FROM expencedetail");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}