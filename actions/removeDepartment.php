<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['department'])) die(header('Location: ../index.php?page=departments'));;
    Department::removeDepartment($db, $_POST['department']);
    die(header('Location: ../index.php?page=departments'));
?>