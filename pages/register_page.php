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

        $prevUsername  = htmlentities($session->getSavedInput(Session::R_USERNAME)  ?? "");
        $prevName      = htmlentities($session->getSavedInput(Session::R_NAME)      ?? "");
        $prevEmail     = htmlentities($session->getSavedInput(Session::R_EMAIL)     ?? "");
        $prevPassword1 = htmlentities($session->getSavedInput(Session::R_PASSWORD1) ?? "");
        $prevPassword2 = htmlentities($session->getSavedInput(Session::R_PASSWORD2) ?? "");
        
        // Draw Page
        drawHeader(false);
?>
<main>
    <div id="register" class="page">
        <h1 id="register-title" class="register title">Register</h1>
        <form action="../actions/register.php" method="post">
            <div class="register-item">
                <span class="register-label">Username</span>
                <input type="text" name="username" required value="<?=$prevUsername?>">
            </div>
            <div class="register-item">
                <span class="register-label">Name</span>
                <input type="text" name="name" required value="<?=$prevName?>">
            </div>
            <div class="register-item">
                <span class="register-label">E-mail</span>
                <input type="email" name="email" required value="<?=$prevEmail?>">
            </div>
            <div class="register-item">
                <span class="register-label">Password</span>
                <input class="password" type="password" name="password1" required value="<?=$prevPassword1?>">
            </div>
            <div class="register-item">
                <span class="register-label">Confirm password</span>
                <input class="password" type="password" name="password2" required value="<?=$prevPassword2?>">
            </div>
            <div class="login-item">
                <input type="checkbox" onclick="toggleShowPasswords()">Show Passwords
            </div>
            <a class="register-item" href="login_page.php">I already have an account.</a>
            <div class="register-item">
                <input class="button" type="submit" value="Register">
            </div>
        </form>
        <?php
            drawToasts($session);
        ?>
    </div>
</main>
<?php
        drawFooter();
    }
?>