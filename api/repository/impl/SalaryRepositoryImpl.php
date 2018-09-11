<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 12:47 PM
 */

require_once __DIR__.'/../SalaryRepository.php';

class SalaryRepositoryImpl implements SalaryRepository{

    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection=$connection;
    }

    public function saveSalary($sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic)
    {
        $result = $this->connection->query("INSERT INTO salary (sDate, totalKm, bonus, amountPerKm, earn, total, nic) VALUES ('{$sDate}','{$totalKm}','{$bonus}','{$amountPerKm}','{$earn}','{$total}','{$nic}')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateSalary($sId, $sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic)
    {
        $result = $this->connection->query("UPDATE salary SET  sDate='{$sDate}', totalKm ='{$totalKm}',bonus ='{$bonus}',amountPerKm ='{$amountPerKm}',earn ='{$earn}',total ='{$total}', nic ='{$nic}' WHERE sId='{$sId}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteSalary($sId)
    {
        $result = $this->connection->query("DELETE FROM salary WHERE sId='{$sId}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findSalary($sId)
    {
        $resultset = $this->connection->query("SELECT * FROM salary WHERE sId='{$sId}'");
        return $resultset->fetch_assoc();
    }

    public function findAllSalaries()
    {
        $resultset = $this->connection->query("SELECT * FROM salary");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}