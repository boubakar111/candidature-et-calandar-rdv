<?php
require_once '../libraries/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : "";

switch ($action) {

    case 1:
        // to add_event
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $start = isset($_POST['start']) ? $_POST['start'] : "";
        $end = isset($_POST['end']) ? $_POST['end'] : "";

         add_event($title ,$start,$end);
        break;
    case 2:

        //pour  supprimer  un evenement
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
         update_event( $title ,$start,$end, $id);
        break;
    case 3:

        //pour modifier un evenement
        $id = $_POST['id'];

        delete_event($id);

        break;
    case '':
       fetch_all_event();
        break;
}

