<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['username'])) {        
        $session->addToast(Session::ERROR, 'Something went wrong.');
        die(header('Location: ../index.php?page=users'));
    }
    if (!isset($_POST['department'])) {        
        $session->addToast(Session::ERROR, 'Missing department.');
        die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
    }
    Agent::removeDepartment($db, $_POST['username'], $_POST['department']);
    $session->addToast(Session::SUCCESS, 'Removed Department Successfully!');
    die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
?>