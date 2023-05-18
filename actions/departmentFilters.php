<?php
    require_once("../classes/session.php");
    require_once("../classes/user.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $session->saveFilter(Session::DEPARTMENT_PRIORITY1, $_POST['priority1']);
    $session->saveFilter(Session::DEPARTMENT_PRIORITY2, $_POST['priority2']);
    $session->saveFilter(Session::DEPARTMENT_PRIORITY3, $_POST['priority3']);
    header('Location: ../pages/department_page.php');
?>