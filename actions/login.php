<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    $session->saveInput(Session::L_USERNAME, $_POST['username']);
    $session->saveInput(Session::L_PASSWORD, $_POST['password']);

    $db = getDatabaseConnection();
    if (!User::usernameExists($db, $_POST['username'])) {
        $session->addToast(Session::ERROR, 'Username doesn\'t exist.');
        die(header('Location: ../index.php?page=login'));
    }
    if (!User::passwordMatchesUser($db, $_POST['username'], $_POST['password'])) {
        $session->addToast(Session::ERROR, 'Wrong password.');
        die(header('Location: ../index.php?page=login'));
    }
    
    $session->logInUser(User::getUser($db, $_POST['username']));
    $session->clearInput();
    die(header('Location: ../index.php?page=dashboard'));
?>