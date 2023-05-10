<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/toast.php");
    // Session
    include_once("../classes/session.php");
    $session = Session::getSession();

    $prevUsername = htmlentities($_SESSION[Session::INPUT][Session::L_USERNAME] ?? "");
    $prevPassword = htmlentities($_SESSION[Session::INPUT][Session::L_PASSWORD] ?? "");
    
    // Draw Page
    drawHeader();
?>
<main>
    <h1 id="login-title" class="login">Login</h1>
    <form id="login" action="../actions/login.php" method="post">
        <div class="login-item">
            <span class="login-label">Username</span>
            <input type="text" name="username" required value="<?=$prevUsername?>">
        </div>
        <div class="login-item">
            <span class="login-label">Password</span>
            <input type="password" name="password" required value="<?=$prevPassword?>">
        </div>
        <a class="login-item" href="register_page.php">I don't have an account.</a>
        <div class="login-item">
            <input class="button" type="submit" value="Login">
        </div>
    </form>
    <?php drawToasts($session); ?>
</main>
<?php  
    drawFooter();
?>
