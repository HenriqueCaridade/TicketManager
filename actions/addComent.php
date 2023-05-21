<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    $db = getDatabaseConnection();

    TicketComment::createTicketComment($db, $_POST['ticket-id'], $_POST['author'], new DateTime(), $_POST['text']);
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['ticket-id']));
?>