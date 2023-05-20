<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/preferences.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $normal = ! is_null($_POST['priority1']);
    $high = ! is_null($_POST['priority2']);
    $urgent = ! is_null($_POST['priority3']);
    $unassigned = ! is_null($_POST['status1']);
    $inProgress = ! is_null($_POST['status2']);
    $done = ! is_null($_POST['status3']);
    $from = Preferences::datetimeLocalToDatetime($_POST['dateFrom']);
    $to = Preferences::datetimeLocalToDatetime($_POST['dateTo']);
    Preferences::updatePreferences($db, $_SESSION[Session::USERNAME], $normal, $high, $urgent, $unassigned, $inProgress, $done, $from, $to);
    die(header('Location: ../index.php?page=departments'));
?>