<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/filters.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $normal     = !is_null($_POST['priority1']);
    $high       = !is_null($_POST['priority2']);
    $urgent     = !is_null($_POST['priority3']);
    $unassigned = !is_null($_POST['status1']);
    $assigned   = !is_null($_POST['status2']);
    $done       = !is_null($_POST['status3']);
    $from       = Filters::datetimeLocalToDatetime($_POST['dateFrom']);
    $to         = Filters::datetimeLocalToDatetime($_POST['dateTo']);
    Filters::updateFilters($db, $_SESSION[Session::USERNAME], $normal, $high, $urgent, $unassigned, $assigned, $done, $from, $to);
    die(header('Location: ../index.php?page=departments'));
?>