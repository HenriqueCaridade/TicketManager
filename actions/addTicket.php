<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    if (!isset($_POST['department']) || !isset($_POST['subject']) || !isset($_POST['text'])) {
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    $db = getDatabaseConnection();
    Ticket::createTicket($db, $_SESSION[Session::USERNAME], new DateTime(), $_POST['subject'], $_POST['text'], $_POST['department']);
    $session->addToast(Session::SUCCESS, 'Added Ticket Successfully!');
    die(header('Location: ../index.php?page=dashboard'));
?>