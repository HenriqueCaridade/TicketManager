<?php
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $_SESSION[Session::INPUT][Session::U_USERNAME] = $_POST['username'];
    $_SESSION[Session::INPUT][Session::U_NAME]     = $_POST['name'];
    $_SESSION[Session::INPUT][Session::U_EMAIL]    = $_POST['email'];

    $db = getDatabaseConnection();

    $user = new User($_POST['username'], $_POST['name'], $_POST['email'], '', $_SESSION[Session::USERTYPE]);
    $validation = $user->validateUpdateParameters($db);

    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../pages/settings.php'));
    }
    $user->updateUserParameters($_SESSION[Session::USERNAME], $db);
    $session->addToast(Session::SUCCESS, 'Information updated successfully!');
    $_SESSION[Session::USERNAME] = $user->username;
    $_SESSION[Session::NAME]     = $user->name;
    $_SESSION[Session::EMAIL]    = $user->email;
    $_SESSION[Session::USERTYPE] = $user->userType;
    unset($_SESSION[Session::INPUT]);
    header('Location: ../pages/settings.php');

?>