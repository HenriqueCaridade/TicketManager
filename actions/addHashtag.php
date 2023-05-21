<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/hashtag.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    
    if (!isset($_POST['value'])) {
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=hashtags'));
    }

    $validation = Hashtag::validatorHashtag($_POST['value']);
    if ($validation !== null) { // Error
        $session->addToast(Session::ERROR, $validation);
        die(header('Location: ../index.php?page=hashtags'));
    }
    
    $db = getDatabaseConnection();
    Hashtag::addHashtag($db, $_POST['value']);
    $session->addToast(Session::SUCCESS, 'Added Hashtag Successfully!');
    die(header('Location: ../index.php?page=hashtags'));
?>