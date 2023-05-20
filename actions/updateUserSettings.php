<?php
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    $session = Session::getSession();

    $session->saveInput(Session::U_USERNAME, $_POST['username']);
    $session->saveInput(Session::U_NAME    , $_POST['name']);
    $session->saveInput(Session::U_EMAIL   , $_POST['email']);

    $db = getDatabaseConnection();

    $validation = User::validateUpdateParameters($db, $_SESSION[Session::USERNAME], $_POST['username'], $_POST['name'], $_POST['email']);
    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../index.php?page=settings'));
    }
    User::updateUserParameters($db, $_SESSION[Session::USERNAME], $_POST['username'], $_POST['name'], $_POST['email']);
    $session->logInUser(User::getUser($db, $_POST['username']));
    $session->clearInput();
    $session->addToast(Session::SUCCESS, 'Information updated successfully!');
    die(header('Location: ../index.php?page=settings'));
?>