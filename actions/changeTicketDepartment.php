<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    
    if (!isset($_POST['id'])) {
        $session->addToast(Session::ERROR, 'Something went wrong.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    if (!isset($_POST['department'])) {
        $session->addToast(Session::ERROR, 'Department Not Received.');
        die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
    }
    
    $db = getDatabaseConnection();
    Ticket::changeDepartment($db, $_POST['id'], $_POST['department']);
    $session->addToast(Session::SUCCESS, 'Changed Department Successfully!');
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
?>