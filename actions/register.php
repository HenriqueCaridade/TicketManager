<?php
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    require_once("../database/connection.php");
    $session = Session::getSession();

    $_SESSION[Session::INPUT][Session::R_USERNAME]  = $_POST['username'];
    $_SESSION[Session::INPUT][Session::R_NAME]      = $_POST['name'];
    $_SESSION[Session::INPUT][Session::R_EMAIL]     = $_POST['email'];
    $_SESSION[Session::INPUT][Session::R_PASSWORD1] = $_POST['password1'];
    $_SESSION[Session::INPUT][Session::R_PASSWORD2] = $_POST['password2'];

    if ($_POST['password1'] !== $_POST['password2']) {
        $session->addToast(Session::ERROR, "Passwords don't match.");
        die(header('Location: ../pages/register_page.php'));
    }
    $db = getDatabaseConnection();

    $user = new User($_POST['username'], $_POST['name'], $_POST['email'], $_POST['password1']);
    $validation = $user->validateParameters($db);
    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../pages/register_page.php'));
    }

    $user->createUser($db);

    $session->addToast(Session::SUCCESS, 'User was created successfully.');
    unset($_SESSION[Session::INPUT]);
    header('Location: ../pages/login_page.php');
?>