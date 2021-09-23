<?php


require_once 'Model.php';

class Calandar extends Model
{

    function fetch_all_event()
    {

        $sqlQuery = "SELECT * FROM tbl_events ORDER BY id";
        $result = $this->pdo->query($sqlQuery);
        $eventArray = $result->fetchAll();
        echo json_encode($eventArray);
    }

    function add_event($title, $start, $end)
    {

        $sqlInsert = "INSERT INTO tbl_events (title,start,end) VALUES ('" . $title . "','" . $start . "','" . $end . "')";
        $stmt = $this->pdo->prepare($sqlInsert);
        $result = $stmt->execute();
        if (!$result) {
            $result = print_r($this->pdo->errorInfo());
        }
    }

    function update_event($title, $start, $end, $id)
    {
        $sqlUpdate = "UPDATE tbl_events SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $id;
        $result = $this->pdo->prepare($sqlUpdate);
        $result->execute();

        return true;

    }

    function delete_event($id)
    {

        $sqlDelete = "DELETE from tbl_events WHERE id=" . $id;
        $result = $this->pdo->prepare($sqlDelete);
        $result->execute();

        return true;
    }

}