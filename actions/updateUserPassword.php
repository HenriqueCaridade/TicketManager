<?php
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    require_once("../database/connection.php");
    $session = Session::getSession();

    $session->saveInput(Session::U_CURR_PASSWORD , $_POST['curr-password']);
    $session->saveInput(Session::U_PASSWORD1     , $_POST['password1']);
    $session->saveInput(Session::U_PASSWORD2     , $_POST['password2']);

    if ($_POST['password1'] !== $_POST['password2']) {
        $session->addToast(Session::ERROR, "Passwords don't match.");
        die(header('Location: ../pages/settings.php'));
    }
    $db = getDatabaseConnection();
    
    $hashedPassword = User::getUserPassword($db, $_SESSION['username']);
    if (!User::passwordMatchesHash($_POST['curr-password'], $hashedPassword)) {
        $session->addToast(Session::ERROR, "Your current password is wrong.");
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
    $session->clearInput();
    header('Location: ../pages/settings.php');
?>