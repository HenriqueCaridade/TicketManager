<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    $session->logOut();

    die(header('Location: ../index.php?page=login'));
?>