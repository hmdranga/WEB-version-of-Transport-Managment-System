<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 10:44 AM
 */
interface SalaryRepository{
    public function setConnection(mysqli $connection);

    public function saveSalary($sDate,$totalKm,$bonus,$amountPerKm,$earn,$total,$nic);

    public function updateSalary($sId,$sDate,$totalKm,$bonus,$amountPerKm,$earn,$total,$nic);

    public function deleteSalary($sId);

    public function findSalary($sId);

    public function findAllSalaries();

}

