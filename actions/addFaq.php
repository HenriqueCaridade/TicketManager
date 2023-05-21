<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/faq.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    if (!isset($_POST['question']) || !isset($_POST['answer'])) {
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=help'));
    }

    $db = getDatabaseConnection();
    FAQ::createFAQ($db, $_POST['question'], $_POST['answer']);
    $session->addToast(Session::SUCCESS, 'FAQ added successfully!');
    die(header('Location: ../index.php?page=help'));
?>