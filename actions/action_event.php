<?php


require_once '../models/Calandar.php';

$calandar = new Calandar();

$action = isset($_POST['action']) ? $_POST['action'] : "";

switch ($action) {

    case 1:
        // to add_event
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $start = isset($_POST['start']) ? $_POST['start'] : "";
        $end = isset($_POST['end']) ? $_POST['end'] : "";

        $calandar->add_event($title, $start, $end);
        break;
    case 2:

        //pour  supprimer  un evenement
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $calandar->update_event($title, $start, $end, $id);
        break;
    case 3:

        //pour modifier un evenement
        $id = $_POST['id'];

        $calandar->delete($id);

        break;
    case '':
        $result  = $calandar->fetch_all_data();
        echo  $result;
        break;
}

