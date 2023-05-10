<?php
    include_once('./classes/session.php');
    $session = Session::getSession();
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ./pages/login_page.php'));
    }
    header('Location: ./pages/dashboard.php');
?>
