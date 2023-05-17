<?php
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/user.php");
    include_once("../classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['department']) || !isset($_POST['username'])) die(header('Location: ../pages/admin.php'));
    Agent::removeDepartment($db, $_POST['username'], $_POST['department']);
    header('Location: ../pages/admin.php');
?>