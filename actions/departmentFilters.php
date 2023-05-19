<?php
    require_once("../classes/session.php");
    require_once("../classes/preferences.php");
    require_once("../database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $normal = ! is_null($_POST['priority1']);
    $high = ! is_null($_POST['priority2']);
    $urgent = ! is_null($_POST['priority3']);
    Preferences::updatePreferences($db, $_SESSION[Session::USERNAME], $normal, $high, $urgent);
    header('Location: ../pages/department_page.php');
?>