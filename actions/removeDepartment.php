<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['department'])) {
        $session->addToast(Session::ERROR, 'Missing department.');
        die(header('Location: ../index.php?page=departments'));
    }
    Department::removeDepartment($db, $_POST['department']);
    $session->addToast(Session::SUCCESS, 'Department Removed Successfully!');
    die(header('Location: ../index.php?page=departments'));
?>