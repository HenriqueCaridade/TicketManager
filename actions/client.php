<?php
    require_once("../classes/session.php");
    require_once("../classes/user.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();

    User::updateUserType($db, $_POST['username'], $_POST['userType']);
    header('Location: ../pages/admin.php');
?>