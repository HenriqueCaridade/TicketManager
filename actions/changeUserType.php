<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['username'])) {
        $session->addToast(Session::ERROR, 'Something went wrong.');
        die(header('Location: ../index.php?page=users'));
    }
    if (!isset($_POST['userType'])) {
        $session->addToast(Session::ERROR, 'Missing User Type.');
        die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
    }
    User::updateUserType($db, $_POST['username'], $_POST['userType']);
    $session->addToast(Session::SUCCESS, 'Changed User Type Successfully!');
    
    die(header('Location: ../index.php?page=account&username=' . $_POST['username']));
?>