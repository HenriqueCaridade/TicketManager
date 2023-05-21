<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");

    $session = Session::getSession();
    if (!isset($_POST['id'])) {
        $session->addToast(Session::ERROR, 'Something went wrong.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    if (!isset($_POST['priority'])) {
        $session->addToast(Session::ERROR, 'Missing priority.');
        die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
    }
    $db = getDatabaseConnection();
    Ticket::changePriority($db, $_POST['id'], $_POST['priority']);
    $session->addToast(Session::SUCCESS, 'Changed Priority Successfully!');
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
?>