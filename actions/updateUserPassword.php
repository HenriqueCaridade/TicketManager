<?php
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    require_once("../database/connection.php");
    $session = Session::getSession();

    $_SESSION[Session::INPUT][Session::N_PASSWORD1] = $_POST['password1'];
    $_SESSION[Session::INPUT][Session::N_PASSWORD2] = $_POST['password2'];
    $db = getDatabaseConnection();

    if ($_POST['password1'] !== $_POST['password2']) {
        $session->addToast(Session::ERROR, "Passwords don't match.");
        die(header('Location: ../pages/settings.php'));
    }

    $user = new User($_SESSION[Session::USERNAME], '', '', $_POST['password1']);
    $validation = $user->validateUpdatePassword($db);

    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../pages/settings.php'));
    }
    $user->updateUserPassword($db);
    $session->addToast(Session::SUCCESS, 'Password changed successfully!');
    unset($_SESSION[Session::INPUT]);
    header('Location: ../pages/settings.php');
?>