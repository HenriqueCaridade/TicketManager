<?php
    require_once("../classes/session.php");
    require_once("../classes/user.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['username']) || !isset($_POST['userType'])) die(header('Location: ../pages/users_page.php'));
    User::updateUserType($db, $_POST['username'], $_POST['userType']);
    header('Location: ../pages/users_page.php');
?>