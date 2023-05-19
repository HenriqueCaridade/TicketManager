<?php
    include_once("../database/connection.php");
    include_once("../templates/user.php");
    include_once("../classes/user.php");
    include_once("../classes/session.php");

    $session = Session::getSession();
    
    if (!isset($_POST['query'])) {
        echo '<p> An Error Occured! </p>';
        die();
    }
    $session->saveInput(Session::S_USER, $_POST['query']);

    $db = getDatabaseConnection();
    $clients = User::getClientsFiltered($db, $_POST['query']);
    drawClients($clients);
?>