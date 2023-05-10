<?php
    include("../templates/header.php");
    session_start();
    $prevUsername = htmlentities($_SESSION['input']['login username'] ?? "");
    $prevPassword = htmlentities($_SESSION['input']['login password'] ?? "");
?>
<main>
    <h1>Login</h1>
    <form action="../actions/login.php" method="post">
        <label class="login-item">Username: <input type="text"     name="username" required value="<?=$prevUsername?>"></label>
        <label class="login-item">Password: <input type="password" name="password" required value="<?=$prevPassword?>"></label>
        <a class="login-item" href="register_page.php">I don't have an account.</a>
        <input class="button login-item" type="submit" value="Login">
    </form>
</main>
<?php  
    include("../templates/footer.php");
?>
