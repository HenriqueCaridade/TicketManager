<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/toast.php");
    // Session
    include_once("../classes/session.php");
    $session = Session::getSession();
    $prevUsername = htmlentities($session->getSavedInput(Session::L_USERNAME) ?? "");
    $prevPassword = htmlentities($session->getSavedInput(Session::L_PASSWORD) ?? "");
    
    // Draw Page
    drawHeader();
?>
<main>
    <div id="login" class="page">
        <h1 id="login-title" class="login title">Login</h1>
        <form action="../actions/login.php" method="post">
            <div class="login-item">
                <span class="login-label">Username</span>
                <input type="text" name="username" required value="<?=$prevUsername?>">
            </div>
            <div class="login-item">
                <span class="login-label">Password</span>
                <input class="password" type="password" name="password" required value="<?=$prevPassword?>">
            </div>
            <div class="login-item">
                <input type="checkbox" onclick="toggleShowPasswords()">Show Password
            </div>
            <a class="login-item" href="register_page.php">I don't have an account.</a>
            <div class="login-item">
                <input class="button" type="submit" value="Login">
            </div>
        </form>
        <?php drawToasts($session); ?>
    </div>
</main>
<?php  
    drawFooter();
?>
