<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/28/2018
 * Time: 10:58 PM
 */
interface ExpenceTypeBO{

    public function getExpenceTypeCount();

    public function getAllExpenceType();

    public function deleteExpenceType($exId);

    public function saveExpenceType($exId, $type);

    public function updateExpenceType($exId, $type);

}