<?php
    date_default_timezone_set("Europe/Lisbon");
    include_once('./classes/session.php');
    $session = Session::getSession();
    if (!$session->isLoggedIn()) {
        die(header('Location: ./pages/login_page.php'));
    }
    header('Location: ./pages/dashboard.php');
?>
