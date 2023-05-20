<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['id']) || !isset($_POST['department'])) die(header('Location: ../index.php?page=departments'));
    Ticket::changeDepartment($db, $_POST['id'], $_POST['department']);
    die(header('Location: ../index.php?page=departments'));
?>