<?php
require_once 'Model.php';

class Candidature extends Model
{
    /**
     * inster candidature
     * @param $poste
     * @param $entreprise
     * @param $ref_ann
     * @param $Date_cand
     * @param $methode_rel
     * @param $date_rel
     * @param $email
     * @param $reponse
     * @param $date_reponse
     * @return bool
     */

    function add_candidature($poste, $entreprise, $ref_ann, $Date_cand, $methode_rel, $date_rel, $email, $reponse, $date_reponse)
    {

        $query = "INSERT INTO `candidatures` ( `poste`, `entreprise`, `ref_ann_site`, `date_candidature`, `methode_relance`, `date_relance`, `email_contact`, `reponse`, `date_reponse`)
              VALUES ( '$poste', '$entreprise', ' $ref_ann', '$Date_cand',        '$methode_rel ',    '$date_rel',   '$email',       '$reponse', '$date_reponse');";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return true;

    }

    /**
     * update candidature
     * @param $column_name
     * @param $value
     * @param $id
     * @return bool
     */
    function update_candidature($column_name, $value, $id)
    {

        $query = "UPDATE candidatures SET " . $column_name . "='" . $value . "' WHERE id = '" . $id . "'";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return true;
    }

    /**
     * delete candidature
     * @param $id
     * @return bool
     */
    function delete_candidature($id)
    {

        $query = "DELETE FROM candidatures WHERE id = " . $id;
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return true;
    }

    /**
     * return all candidature  and candidature with option
     * @param $columns
     * @return array
     */
    function fetch_all_candidature($columns)
    {

        $query = "SELECT * FROM Candidatures ";

        if (isset($_POST["search"]["value"])) {

            $query .= ' WHERE entreprise LIKE "%' . $_POST["search"]["value"] . '%" 
                   OR ref_ann_site LIKE "%' . $_POST["search"]["value"] . '%" 
                   OR date_candidature LIKE "%' . $_POST["search"]["value"] . '%"';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
        ';
        } else {
            $query .= 'ORDER BY date_candidature DESC ';
        }

        $query1 = '';

        if ($_POST["length"] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $number_filter_row = $this->pdo->prepare($query);

        $stm = $this->pdo->prepare($query . $query1);

        $stm->execute();
        return $stm->fetchAll()  ;

    }

    /**
     * @return bool
     */
   public  function get_all_data()
    {

        $query = "SELECT * FROM Candidatures";
        $stm = $this->pdo->prepare($query);
        $result = $stm->execute();
        return $result;
    }

}