<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    $session->logOut();
    die(header('Location: ../index.php?page=login'));
?>