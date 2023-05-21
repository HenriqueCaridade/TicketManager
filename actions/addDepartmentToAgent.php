<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    
    if (!isset($_POST['username'])) {        
        $session->addToast(Session::ERROR, 'Something went wrong.');
        die(header('Location: ../index.php?page=users'));
    }
    if (!isset($_POST['department'])) {        
        $session->addToast(Session::ERROR, 'Missing department.');
        die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
    }
    
    $db = getDatabaseConnection();
    Agent::addDepartment($db, $_POST['username'], $_POST['department']);
    $session->addToast(Session::SUCCESS, 'Added Department to ' . $_POST['username'] . ' Successfully!');
    die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
?>