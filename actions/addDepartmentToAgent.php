<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['department']) || !isset($_POST['username'])){
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=users'));
    }
    Agent::addDepartment($db, $_POST['username'], $_POST['department']);
    $session->addToast(Session::SUCCESS, 'Added Department to ' . $_POST['username'] . ' Successfully!');
    die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
?>