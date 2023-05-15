<?php
    require_once("../classes/session.php");
    require_once("../classes/user.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();

    User::updateUserType($db, $_SESSION[Session::USERNAME], $_POST['usertype']);
    header('Location: ../pages/admin.php');
?>