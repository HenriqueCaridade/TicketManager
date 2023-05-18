<?php
    include_once("../database/connection.php");
    include_once("../templates/user.php");
    include_once("../classes/user.php");

    if (!isset($_POST['query'])) {
        echo '<p> An Error Occured! </p>';
        die();
    }
    $db = getDatabaseConnection();
    $clients = User::getClientsFiltered($db, $_POST['query']);
    drawClients($clients);
?>