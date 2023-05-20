<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['name']) || !isset($_POST['abbrev'])) die(header('Location: ../index.php?page=departments'));
    Department::addDepartment($db, $_POST['name'], $_POST['abbrev']);
    die(header('Location: ../index.php?page=departments'));
?>