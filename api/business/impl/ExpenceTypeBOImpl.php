<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/28/2018
 * Time: 11:26 PM
 */

require_once __DIR__ . '/../ExpenceTypeBO.php';
require_once __DIR__ . '/../../repository/impl/ExpenceTypeRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class ExpenceTypeBOImpl implements ExpenceTypeBO{

    private $expenceTypeRepository;

    function __construct()
    {
        $this->expenceTypeRepository = new ExpenceTypeRepositoryImpl();
    }

    public function getExpenceTypeCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenceTypeRepository->setConnection($connection);

        $count =  count($this->expenceTypeRepository->findAllExpenceTypes());

        mysqli_close($connection);

        return $count;
    }

    public function getAllExpenceType()
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenceTypeRepository->setConnection($connection);

        $expenceType = $this->expenceTypeRepository->findAllExpenceTypes();

        mysqli_close($connection);

        return $expenceType;
    }

    public function deleteExpenceType($exId)
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenceTypeRepository->setConnection($connection);

        $result = $this->expenceTypeRepository->deleteExpenceType($exId);

        mysqli_close($connection);

        return $result;
    }

    public function saveExpenceType($exId, $type)
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenceTypeRepository->setConnection($connection);

        $expenceType = $this->expenceTypeRepository->saveExpenceType($exId, $type);

        mysqli_close($connection);

        return $expenceType;
    }

    public function updateExpenceType($exId, $type)
    {
        $connection = (new DBConnection())->getConnection();
        $this->expenceTypeRepository->setConnection($connection);

        $expenceType = $this->expenceTypeRepository->updateExpenceType($exId, $type);

        mysqli_close($connection);

        return $expenceType;
    }
}