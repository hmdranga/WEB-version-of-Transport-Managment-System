<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/28/2018
 * Time: 10:30 PM
 */

require_once __DIR__ . '/../ExpenceTypeRepository.php';

class ExpenceTypeRepositoryImpl implements ExpenceTypeRepository{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveExpenceType($exId, $type)
    {
        $result = $this->connection->query("INSERT INTO expencetype (exId , type ) VALUES ('{$exId}','{$type}')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateExpenceType($exId, $type)
    {
        $result = $this->connection->query("UPDATE expencetype SET  type='{$type}' WHERE exId='{$exId}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteExpenceType($exId)
    {
        $result = $this->connection->query("DELETE FROM expencetype WHERE exId='{$exId}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findExpenceType($exId)
    {
        $resultset = $this->connection->query("SELECT * FROM expencetype WHERE exId='{$exId}'");
        return $resultset->fetch_assoc();
    }

    public function findAllExpenceTypes()
    {
        $resultset = $this->connection->query("SELECT * FROM expencetype");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}