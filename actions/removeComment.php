<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    TicketComment::removeTicketComment($db, $_POST['comment-id']);
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['ticket-id']));
?>