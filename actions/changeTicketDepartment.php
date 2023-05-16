<?php
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/ticket.php");
    include_once("../classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['id']) || !isset($_POST['department'])) die(header('Location: ../pages/agent.php'));
    Ticket::changeDepartment($db, $_POST['id'], $_POST['department']);
    header('Location: ../pages/agent.php');
?>