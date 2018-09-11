<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 1:08 PM
 */
interface SalaryBO{
    public function getSalariesCount();

    public function getAllSalaries();

    public function deleteSalary($sId);

    public function saveSalary($sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic);

    public function updateSalary($sId, $sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic);
}