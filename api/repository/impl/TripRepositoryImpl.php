<?php
/**
 * Created by IntelliJ IDEA.
 * User: A C E R
 * Date: 7/26/2018
 * Time: 10:56 AM
 */
require_once __DIR__ . '/../TripRepository.php';

class TripRepositoryImpl implements TripRepository{

    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveTrip($id, $date, $start, $end, $regNo, $nic)
    {
        $result = $this->connection->query("INSERT INTO tripdetail (id ,date , start, end, regNo, nic) VALUES ('{$id}','{$date}','{$start}','{$end}','{$regNo}','{$nic}')");
        //echo $this->connection->error;
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateTrip($id, $date, $start, $end, $regNo, $nic)
    {
        $result = $this->connection->query("UPDATE tripdetail SET  date='{$date}', start ='{$start}',end ='{$end}',regNo ='{$regNo}',nic ='{$nic}'  WHERE id='{$id}'");
        //echo $this->connection->error;
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteTrip($id)
    {
        $result = $this->connection->query("DELETE FROM tripdetail WHERE id='{$id}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findTrip($id)
    {
        $resultset = $this->connection->query("SELECT * FROM tripdetail WHERE id='{$id}'");
        return $resultset->fetch_assoc();
    }

    public function findAllTrips()
    {
        $resultset = $this->connection->query("SELECT * FROM tripdetail");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function countTotalKm( $sDate, $nic)
    {
        $result = $this->connection->query("SELECT SUM(END) - SUM(START) AS TOTAL FROM TRIPDETAIL WHERE DATE BETWEEN '{$sDate}' AND CURDATE() AND nic ='{$nic}'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}