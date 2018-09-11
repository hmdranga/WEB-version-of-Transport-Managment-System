<?php
/**
 * Created by IntelliJ IDEA.
 * User: ranjith-suranga
 * Date: 7/20/18
 * Time: 3:42 PM
 */

require_once __DIR__ . '/../VehicleRepository.php';

class VehicleRepositoryImpl implements VehicleRepository
{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveVehicle($vregNo, $vbrand, $vcolor, $vboughtdate)
    {
        $result = $this->connection->query("INSERT INTO vehicle VALUES ('{$vregNo}','{$vbrand}','{$vcolor}','{$vboughtdate}')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateVehicle($vregNo, $vbrand, $vcolor, $vboughtdate)
    {
        $result = $this->connection->query("UPDATE vehicle SET  brand='{$vbrand}', colour ='{$vcolor}',boughtDate ='{$vboughtdate}' WHERE regNo='{$vregNo}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteVehicle($vregNo)
    {
        $result = $this->connection->query("DELETE FROM vehicle WHERE regNo='{$vregNo}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findVehicle($vregNo)
    {
        $resultset = $this->connection->query("SELECT * FROM vehicle WHERE regNo='{$vregNo}'");
        return $resultset->fetch_assoc();
    }

    public function findAllVehicles()
    {
        $resultset = $this->connection->query("SELECT * FROM vehicle");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}