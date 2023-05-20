<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/templates/user.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/session.php");

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