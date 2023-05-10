<?php
    require_once("../database/connection.php");
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    $session = Session::getSession();

    $_SESSION[Session::INPUT][Session::L_USERNAME] = $_POST['username'];
    $_SESSION[Session::INPUT][Session::L_PASSWORD] = $_POST['password'];

    $db = getDatabaseConnection();
    $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);
    if ($user === null) {
        if (User::usernameExists($db, $_POST['username']))
            $session->addToast(Session::ERROR, 'Wrong password.');
        else $session->addToast(Session::ERROR, 'Username doesn\'t exist.');
        die(header('Location: ../pages/login_page.php'));
    }
    $_SESSION[Session::USERNAME] = $user->username;
    $_SESSION[Session::NAME]     = $user->name;
    $_SESSION[Session::EMAIL]    = $user->email;
    $_SESSION[Session::USERTYPE] = $user->userType;
    
    unset($_SESSION[Session::INPUT]);
    header('Location: ../pages/dashboard.php');
?>