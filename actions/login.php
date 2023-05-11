<?php
    require_once("../database/connection.php");
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    $session = Session::getSession();

    $session->saveInput(Session::L_USERNAME, $_POST['username']);
    $session->saveInput(Session::L_PASSWORD, $_POST['password']);

    $db = getDatabaseConnection();
    $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);
    if ($user === null) {
        if (User::usernameExists($db, $_POST['username']))
            $session->addToast(Session::ERROR, 'Wrong password.');
        else $session->addToast(Session::ERROR, 'Username doesn\'t exist.');
        die(header('Location: ../pages/login_page.php'));
    }
    
    $session->logInUser($user);
    $session->clearInput();
    header('Location: ../pages/dashboard.php');
?>