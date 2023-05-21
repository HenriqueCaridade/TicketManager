<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();

    TicketComment::createTicketComment($db, $_POST['ticket-id'], $_POST['author'], new DateTime(), $_POST['text']);
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['ticket-id']));
?>