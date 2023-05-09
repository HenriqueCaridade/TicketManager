<?php
    require ("../database/connection.php");
    session_start();

    $_SESSION['input']['newUser username'] = htmlentities($_POST['username']);
    $_SESSION['input']['newUser name '] = htmlentities($_POST['name']);
    $_SESSION['input']['newUser email'] = htmlentities($_POST['email']);
    $_SESSION['input']['newUser password1 '] = htmlentities($_POST['password1']);
    $_SESSION['input']['newUser password2'] = htmlentities($_POST['password2']);

    $db = getDatabaseConnection();
    if ($_POST['password1'] === $_POST['password2']) {
        $stmt = $db->prepare('INSERT INTO User (username, name, password, email, userType) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_POST['username'], $_POST['name'], $_POST['email'], sha1($_POST['password1']), 'Client'));

    } 
    else {
        die(header('Location: ../templates/registerForm.php'));
    }

    header('Location: ../index.php');
    unset($_SESSION['input']);
?>