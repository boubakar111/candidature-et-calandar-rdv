<?php
require_once '../libraries/database.php';

abstract  class Model
{

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPDO();
    }


    /**
     *  retourne la liste des rendez-vous  ou candidature  sous format tableau JSON
     */
    function fetch_all_data($order = "")
    {

        $sqlQuery = "SELECT * FROM {$this->table} ";
        if ($order) {
            $sqlQuery .= " ORDER BY " . $order ." DESC ";
        }
        $result = $this->pdo->query($sqlQuery);
        $items = $result->fetchAll();
        return json_encode($items);
    }


    /**
     * delete pour  candidature  et  events
     * @param $id
     * @return bool
     */
    function delete($id)
    {


        $query = "DELETE FROM {$this->table}  WHERE id = " . $id;
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return true;
    }

}