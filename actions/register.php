<?php
    require_once("../classes/user.php");
    require_once("../database/connection.php");
    session_start();

    $_SESSION['input']['register username']  = $_POST['username'];
    $_SESSION['input']['register name']      = $_POST['name'];
    $_SESSION['input']['register email']     = $_POST['email'];
    $_SESSION['input']['register password1'] = $_POST['password1'];
    $_SESSION['input']['register password2'] = $_POST['password2'];

    if ($_POST['password1'] !== $_POST['password2']) {
        die(header('Location: ../pages/register_page.php'));
    }
    $db = getDatabaseConnection();
    $stmt = $db->prepare('INSERT INTO User (username, name, password, email, userType) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($_POST['username'], $_POST['name'], User::passwordHash($_POST['password1']), $_POST['email'], 'Client'));
    
    unset($_SESSION['input']);
    header('Location: ../pages/login_page.php');
?>