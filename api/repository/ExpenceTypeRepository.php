<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/28/2018
 * Time: 10:20 PM
 */
interface ExpenceTypeRepository{
    public function setConnection(mysqli $connection);

    public function saveExpenceType($exId,$type);

    public function updateExpenceType($exId,$type);

    public function deleteExpenceType($exId);

    public function findExpenceType($exId);

    public function findAllExpenceTypes();
}