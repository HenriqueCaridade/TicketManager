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
    if (!isset($_POST['action']) || ($_POST['action'] === 'Assign' && !isset($_POST['username']))) {
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
    }

    $db = getDatabaseConnection();
    if ($_POST['action'] === 'Assign') {
        if (empty($_POST['username'])) {
            Ticket::changeStatusAndAgent($db, $_POST['id'], Ticket::UNASSIGNED);
        } else {
            $user = User::getUser($db, $_POST['username']);
            if ($user === null) {
                $session->addToast(Session::ERROR, 'Username given doesn\'t exist.');
                die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
            }
            if (!Session::getRights($user->userType, User::USERTYPE_AGENT)) {
                $session->addToast(Session::ERROR, 'User given isn\'t an agent.');
                die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
            }
            $ticket = Ticket::getTicket($db, $_POST['id']);
            $user = Agent::getAgent($db, $_POST['username']);
            if (!in_array($ticket->department, $user->departments)) {
                $session->addToast(Session::ERROR, 'Agent given isn\'t in the ' . $ticket->department . ' Department.');
                die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
            }
            Ticket::changeStatusAndAgent($db, $_POST['id'], Ticket::ASSIGNED, $_POST['username']);
        }
    } else if ($_POST['action'] === 'Undone') {
        Ticket::changeStatusAndAgent($db, $_POST['id'], Ticket::ASSIGNED);
    } else if ($_POST['action'] === 'Done') {
        Ticket::changeStatusAndAgent($db, $_POST['id'], Ticket::DONE);
    }
    $session->addToast(Session::SUCCESS, 'Changed Status Successfully!');
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['id']));
?>