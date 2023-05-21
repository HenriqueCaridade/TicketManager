<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/hashtag.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }

    if (!isset($_POST['hashtag'])) {
        $session->addToast(Session::ERROR, 'Missing Hashtag.');
        die(header('Location: ../index.php?page=hashtags'));
    }
    
    $db = getDatabaseConnection();
    Hashtag::removeHashtag($db, $_POST['hashtag']);
    $session->addToast(Session::SUCCESS, 'Hashtag Removed Successfully!');
    die(header('Location: ../index.php?page=hashtags'));
?>