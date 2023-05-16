<?php
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    require_once("../database/connection.php");
    $session = Session::getSession();

    $session->saveInput(Session::R_USERNAME , $_POST['username']);
    $session->saveInput(Session::R_NAME     , $_POST['name']);
    $session->saveInput(Session::R_EMAIL    , $_POST['email']);
    $session->saveInput(Session::R_PASSWORD1, $_POST['password1']);
    $session->saveInput(Session::R_PASSWORD2, $_POST['password2']);

    if ($_POST['password1'] !== $_POST['password2']) {
        $session->addToast(Session::ERROR, "Passwords don't match.");
        die(header('Location: ../pages/register_page.php'));
    }
    $db = getDatabaseConnection();

    $validation = User::validateParameters($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password1']);
    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../pages/register_page.php'));
    }
    User::createUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password1']);

    $session->addToast(Session::SUCCESS, 'User was created successfully.');
    $session->clearInput();
    header('Location: ../pages/login_page.php');
?>