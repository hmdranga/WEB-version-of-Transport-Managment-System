<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/29/2018
 * Time: 1:12 PM
 */
//require_once __DIR__ . '/../TripBO.php';
require_once __DIR__ . '/../SalaryBO.php';
require_once __DIR__ . '/../../repository/impl/SalaryRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';


class SalaryBOImpl implements SalaryBO{

    private $salaryRepository;


    function __construct()
    {
        $this->salaryRepository = new SalaryRepositoryImpl();
    }


    public function getSalariesCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->salaryRepository->setConnection($connection);

        $count =  count($this->salaryRepository->findAllSalaries());

        mysqli_close($connection);

        return $count;
    }

    public function getAllSalaries()
    {
        $connection = (new DBConnection())->getConnection();
        $this->salaryRepository->setConnection($connection);

        $salaries = $this->salaryRepository->findAllSalaries();

        mysqli_close($connection);

        return $salaries;
    }

    public function deleteSalary($sId)
    {
        $connection = (new DBConnection())->getConnection();
        $this->salaryRepository->setConnection($connection);

        $result = $this->salaryRepository->deleteSalary($sId);

        mysqli_close($connection);

        return $result;
    }

    public function saveSalary($sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic)
    {
        $connection = (new DBConnection())->getConnection();
        $this->salaryRepository->setConnection($connection);

        $salary = $this->salaryRepository->saveSalary($sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic);

        mysqli_close($connection);

        return $salary;
    }

    public function updateSalary($sId, $sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic)
    {
        $connection = (new DBConnection())->getConnection();
        $this->salaryRepository->setConnection($connection);

        $salary = $this->salaryRepository->updateSalary($sId, $sDate, $totalKm, $bonus, $amountPerKm, $earn, $total, $nic);

        mysqli_close($connection);

        return $salary;
    }
}
