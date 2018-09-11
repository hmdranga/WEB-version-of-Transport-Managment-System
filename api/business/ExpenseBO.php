<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 7:06 AM
 */
interface ExpenseBO{
    public function getExpensesCount();

    public function getAllExpenses();

    public function deleteExpense($vregNo,$exId);

    public function saveExpense($vregNo,$exId,$exDate,$amount,$description);

    public function updateExpense($vregNo,$exId,$exDate,$amount,$description);

}