<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['department']) || !isset($_POST['username'])) die(header('Location: ../index.php?page=users'));;
    Agent::removeDepartment($db, $_POST['username'], $_POST['department']);
    die(header('Location: ../index.php?page=users'));
?>