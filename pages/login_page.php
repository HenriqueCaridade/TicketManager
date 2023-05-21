<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/toast.php");
    // Classes
    require_once(dirname(__DIR__) . "/classes/session.php");
    // Session
    $session = Session::getSession();
    
    function drawPage(array $getArray) {
        global $session;

        $prevUsername = htmlentities($session->getSavedInput(Session::L_USERNAME) ?? "");
        $prevPassword = htmlentities($session->getSavedInput(Session::L_PASSWORD) ?? "");
        
        // Draw Page
        drawHeader(false);
?>
<main>
    <div id="login" class="logres-page">
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
            <a class="login-item" href="./index.php?page=register">I don't have an account.</a>
            <div class="login-item">
                <input class="button" type="submit" value="Login">
            </div>
            <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
        </form>
        <?php drawToasts($session); ?>
    </div>
</main>
<?php  
        drawFooter();
    }
?>
