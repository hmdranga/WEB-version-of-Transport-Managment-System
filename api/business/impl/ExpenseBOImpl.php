<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 7:20 AM
 */

require_once __DIR__ . '/../ExpenseBO.php';
require_once __DIR__ . '/../../repository/impl/ExpenseRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class ExpenseBOImpl implements ExpenseBO{

    private $expenseRepository;

    function __construct()
    {
        $this->expenseRepository = new ExpenseRepositoryImpl();
    }

    public function getExpensesCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenseRepository->setConnection($connection);

        $count =  count($this->expenseRepository->findAllExpenses());

        mysqli_close($connection);

        return $count;
    }

    public function getAllExpenses()
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenseRepository->setConnection($connection);

        $expenses = $this->expenseRepository->findAllExpenses();

        mysqli_close($connection);

        return $expenses;
    }

    public function deleteExpense($vregNo, $exId)
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenseRepository->setConnection($connection);

        $result = $this->expenseRepository->deleteExpense($vregNo, $exId);

        mysqli_close($connection);

        return $result;
    }

    public function saveExpense($vregNo, $exId, $exDate, $amount, $description)
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenseRepository->setConnection($connection);

        $expense = $this->expenseRepository->saveExpense($vregNo, $exId, $exDate, $amount, $description);

        mysqli_close($connection);

        return $expense;
    }

    public function updateExpense($vregNo, $exId, $exDate, $amount, $description)
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenseRepository->setConnection($connection);

        $expense = $this->expenseRepository->updateExpense($vregNo, $exId, $exDate, $amount, $description);

        mysqli_close($connection);

        return $expense;
    }
}