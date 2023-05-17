<?php
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/user.php");
    include_once("../classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['department'])) die(header('Location: ../pages/department_page.php'));
    // TODO
    header('Location: ../pages/department_page.php');
?>