<?php
    include_once("../database/connection.php");
    include_once("../templates/user.php");
    include_once("../classes/user.php");

    if (!isset($_POST['query'])) {
        echo '<p> An Error Occured! </p>';
        die();
    }
    $db = getDatabaseConnection();
    $agents = Agent::getAgentsFiltered($db, $_POST['query']);
    drawAgents($agents);
?>