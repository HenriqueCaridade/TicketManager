<?php
    require_once("../classes/user.php");
    require_once("../classes/session.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $session->saveInput(Session::U_USERNAME, $_POST['username']);
    $session->saveInput(Session::U_NAME    , $_POST['name']);
    $session->saveInput(Session::U_EMAIL   , $_POST['email']);

    $db = getDatabaseConnection();

    $user = new User($_POST['username'], $_POST['name'], $_POST['email'], '', $_SESSION[Session::USERTYPE]);
    $validation = $user->validateUpdateParameters($db);

    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../pages/settings.php'));
    }
    $user->updateUserParameters($_SESSION[Session::USERNAME], $db);
    $session->logInUser($user);
    $session->addToast(Session::SUCCESS, 'Information updated successfully!');
    $session->clearInput();
    header('Location: ../pages/settings.php');

?>