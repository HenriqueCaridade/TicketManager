<?php
    require_once("../classes/session.php");
    $session = Session::getSession();

    unset($_SESSION[Session::USERNAME]);
    unset($_SESSION[Session::NAME]);
    unset($_SESSION[Session::EMAIL]);
    unset($_SESSION[Session::USERTYPE]);

    header('Location: ../pages/login_page.php');
?>