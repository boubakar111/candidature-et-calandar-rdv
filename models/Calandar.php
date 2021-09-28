<?php


require_once 'Model.php';

class Calandar extends Model
{

    protected  $table = "tbl_events";

    /**
     * ajouter un rendez-vous
     * @param $title
     * @param $start
     * @param $end
     */
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


}