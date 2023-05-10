<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/toast.php");
    // Session
    include_once("../classes/session.php");
    $session = Session::getSession();

    $prevUsername  = htmlentities($_SESSION[Session::INPUT][Session::R_USERNAME]  ?? "");
    $prevName      = htmlentities($_SESSION[Session::INPUT][Session::R_NAME]      ?? "");
    $prevEmail     = htmlentities($_SESSION[Session::INPUT][Session::R_EMAIL]     ?? "");
    $prevPassword1 = htmlentities($_SESSION[Session::INPUT][Session::R_PASSWORD1] ?? "");
    $prevPassword2 = htmlentities($_SESSION[Session::INPUT][Session::R_PASSWORD2] ?? "");

    // Draw Page
    drawHeader();
?>
<main>
    <h1 id="register-title" class="register">Register</h1>
    <form id="register" action="../actions/register.php" method="post">
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
            <input type="password" name="password1" required value="<?=$prevPassword1?>">
        </div>
        <div class="register-item">
            <span class="register-label">Confirm password</span>
            <input type="password" name="password2" required value="<?=$prevPassword2?>">
        </div>
        <a class="register-item" href="login_page.php">I already have an account.</a>
        <div class="register-item">
            <input class="button" type="submit" value="Register">
        </div>
    </form>
    <?php drawToasts($session); ?>
</main>
<?php
    drawFooter();
?>