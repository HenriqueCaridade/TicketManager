<?php
    require_once("../database/connection.php");
    require_once("../classes/user.php");
    session_start();

    $_SESSION['input']['login username'] = $_POST['username'];
    $_SESSION['input']['login password'] = $_POST['password'];

    $db = getDatabaseConnection();
    $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);
    if ($user === null) {
        die(header('Location: ../pages/login_page.php'));
    }
    $_SESSION['username'] = $user->username;
    $_SESSION['name']     = $user->name;
    $_SESSION['email']    = $user->email;
    $_SESSION['userType'] = $user->userType;
    
    unset($_SESSION['input']);
    header('Location: ../pages/dashboard.php');
?>