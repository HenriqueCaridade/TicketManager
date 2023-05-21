<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    if (!isset($_POST['id'])) {        
        $session->addToast(Session::ERROR, 'Something went wrong.');
        die(header('Location: ../index.php?page=users'));
    }
    if (!isset($_POST['hashtag'])) {        
        $session->addToast(Session::ERROR, 'Missing hashtag.');
        die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
    }
    
    $db = getDatabaseConnection();
    Ticket::removeHashtag($db, $_POST['id'], $_POST['hashtag']);
    $session->addToast(Session::SUCCESS, 'Removed Hashtag Successfully!');
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
?>