<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    if (!isset($_POST['name']) || !isset($_POST['abbrev'])) {
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=departments'));
    }

    $db = getDatabaseConnection();
    Department::addDepartment($db, $_POST['name'], $_POST['abbrev']);
    $session->addToast(Session::SUCCESS, 'Added Department Successfully!');
    die(header('Location: ../index.php?page=departments'));
?>