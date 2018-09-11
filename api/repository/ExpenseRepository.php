<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 5:58 AM
 */
interface ExpenseRepository{
    public function setConnection(mysqli $connection);

    public function saveExpense($vregNo,$exId,$exDate,$amount,$description);

    public function updateExpense($vregNo,$exId,$exDate,$amount,$description);

    public function deleteExpense($vregNo,$exId);

    public function findExpense($vregNo,$exId);

    public function findAllExpenses();
}