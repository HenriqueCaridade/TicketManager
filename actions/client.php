<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['username']) || !isset($_POST['userType'])) die(header('Location: ../index.php?page=users'));
    User::updateUserType($db, $_POST['username'], $_POST['userType']);
    die(header('Location: ../index.php?page=users'));
?>