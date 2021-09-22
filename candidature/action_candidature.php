<?php

require_once '../libraries/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : "";
//var_dump( $action);die();
switch ($action) {

    case 1:
        if (isset($_POST["Poste"], $_POST["Entreprise"], $_POST["Ref_ann"], $_POST["Methode_rel"], $_POST["Date_rel"], $_POST["Email"], $_POST["Reponse"], $_POST["Date_reponse"])) {
            $poste = $_POST["Poste"];
            $entreprise = $_POST["Entreprise"];
            $ref_ann = $_POST["Ref_ann"];
            $Date_cand = Date("Y-m-d");
            $methode_rel = $_POST["Methode_rel"];
            $date_rel = $_POST["Date_rel"];
            $email = $_POST["Email"];
            $reponse = $_POST["Reponse"];
            $date_reponse = $_POST["Date_reponse"];
            $result = add_candidature($poste, $entreprise, $ref_ann, $Date_cand, $methode_rel, $date_rel, $email, $reponse, $date_reponse);
            if ($result == true) {
                echo 'Candidature bien enregistré ';
            }
        }

        break;
    case 2:
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $value = $_POST["value"];
            $column_name = $_POST["column_name"];
            $result = update_candidature($column_name, $value, $id);

            if ($result == true) {
                echo 'votre modification à bien été prise en compte ';
            }
        }

        break;
    case 3:

        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $result = delete_candidature($id);
            if ($result == true) {
                echo 'votre candidature à bien été supprimé';
            }
        }
        break;

    case 4:
        $pdo = getPDO();
        $columns = array('Poste', 'Entreprise', 'Ref_ann_site', 'Date_candidature', 'Methode_relance', 'Date_relance', 'email_contact', 'reponse', 'Date_reponse');

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

        $number_filter_row = $pdo->prepare($query);

        $result = $pdo->prepare($query . $query1);

        $result->execute();

        $data = array();
        $now = date('Y-m-d');
        $jour = "jours";
        function diffJour($date, $now)
        {
            $result = round((strtotime($now) - strtotime($date)) / 86400);
            if ($result <= 7) {
                return '<span style="background-color yellowgreen">' . $result . "- jours" . '</span>';
            } elseif ($result > 7 && $result <= 15) {
                return '<span style="background-color :red">' . $result . "- jours" . '</span>';
            } elseif ($result > 15) {
                return '<span style="background-color  : yellow">' . $result . "- jours" . '</span>';
            }
            return $result;
        }

        while ($row = $result->fetch()) {
            $sub_array = array();
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="poste">' . $row["poste"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="entreprise">' . $row["entreprise"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="ref_ann_site">' . $row["ref_ann_site"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="date_candidature">' . $row["date_candidature"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="methode_relance">' . $row["methode_relance"] . '</div>';
            $sub_array[] = '<div contenteditable ="false" class="update" data-id="' . $row["id"] . '" data-column="date_relance">'
                . diffJour($row['date_candidature'], $now) . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="email_contact">' . $row["email_contact"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="reponse">' . $row["reponse"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="date_reponse">' . $row["date_reponse"] . '</div>';
            $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="' . $row["id"] . '">Delete</button>';
            $data[] = $sub_array;
        }

        function get_all_data($pdo)
        {
            $pdo = getPDO();
            $query = "SELECT * FROM Candidatures";
            $stm = $pdo->prepare($query);
            $result = $stm->execute();
            return $result;
        }

        function def_date_relance($pdo)
        {
            $query = "SELECT date_candidature FROM Candidature";
            $stm = $pdo->prepare($query);
            $result = $stm->excute();
            return $result;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => get_all_data($pdo),
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        echo json_encode($output);
        break;
}