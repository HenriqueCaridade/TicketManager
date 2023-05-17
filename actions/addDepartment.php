<?php
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/user.php");
    include_once("../classes/department.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    if (!isset($_POST['name']) || !isset($_POST['abbrev'])) die(header('Location: ../pages/department_page.php'));
    Department::addDepartment($db, $_POST['name'], $_POST['abbrev']);
    header('Location: ../pages/department_page.php');
?>