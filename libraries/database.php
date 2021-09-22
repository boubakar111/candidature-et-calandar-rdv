<?php

/**
 * retourn une connexion à la base de données
 * @return PDO
 */
function getPDO(): PDO
{
    $pdo = new PDO('mysql:host=localhost;dbname=candidaturepoleemploi;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    return $pdo;
}

function fetch_all_event()
{
    $pdo = getPDO();
    $sqlQuery = "SELECT * FROM tbl_events ORDER BY id";
    $result = $pdo->query($sqlQuery);
    $eventArray = $result->fetchAll();
    echo json_encode($eventArray);
}

function add_event($title, $start, $end)
{
    $pdo = getPDO();
    $sqlInsert = "INSERT INTO tbl_events (title,start,end) VALUES ('" . $title . "','" . $start . "','" . $end . "')";
    $stmt = $pdo->prepare($sqlInsert);
    $result = $stmt->execute();
    if (!$result) {
        $result = print_r($pdo->errorInfo());;
    }
}

function update_event($title, $start, $end, $id)
{
    $pdo = getPDO();
    $sqlUpdate = "UPDATE tbl_events SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $id;
    $result = $pdo->prepare($sqlUpdate);
    $result->execute();

}

function delete_event($id)
{
    $pdo = getPDO();
    $sqlDelete = "DELETE from tbl_events WHERE id=" . $id;
    $result = $pdo->prepare($sqlDelete);
    $result->execute();
}

/**------------------------ candidature-------------------*/

function add_candidature($poste, $entreprise, $ref_ann, $Date_cand, $methode_rel, $date_rel, $email, $reponse, $date_reponse)
{
    $pdo = getPDO();
    $query = "INSERT INTO `candidatures` ( `poste`, `entreprise`, `ref_ann_site`, `date_candidature`, `methode_relance`, `date_relance`, `email_contact`, `reponse`, `date_reponse`)
              VALUES ( '$poste', '$entreprise', ' $ref_ann', '$Date_cand',        '$methode_rel ',    '$date_rel',   '$email',       '$reponse', '$date_reponse');";
    $stm = $pdo->prepare($query);
    $stm->execute();
    return true ;

}

function update_candidature($column_name ,$value ,$id)
{
    $pdo = getPDO();
    $query = "UPDATE candidatures SET ".$column_name."='".$value."' WHERE id = '".$id."'";
    $stm = $pdo->prepare($query);
    $stm->execute();
    return true ;
}



function delete_candidature($id)
{
    $pdo = getPDO();
    $query = "DELETE FROM candidatures WHERE id = ".$id ;
    $stm = $pdo->prepare($query);
    $stm->execute();
    return true ;
}

function fetch_all_candidature()
{



}



function find_candidature_by()
{

}

