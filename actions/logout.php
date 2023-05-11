<?php
    require_once("../classes/session.php");
    $session = Session::getSession();
    $session->logOut();

    header('Location: ../pages/login_page.php');
?>