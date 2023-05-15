<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/toast.php");
    // Session
    include_once("../classes/session.php");
    include_once("../classes/user.php");
    $session = Session::getSession();
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }

    $prevCurrPassword = htmlentities($_SESSION[Session::INPUT][Session::U_CURR_PASSWORD]);
    $prevPassword1    = htmlentities($_SESSION[Session::INPUT][Session::U_PASSWORD1]);
    $prevPassword2    = htmlentities($_SESSION[Session::INPUT][Session::U_PASSWORD2]);

    // Draw Page
    drawHeader(true);
    drawSidebar($session);
?>
<main class="main-sidebar">
    <div id="settings" class="page">
        <h1 id="update-title" class="register title">Manage personal information</h1>
        <form id="update-info" action="../actions/updateUserSettings.php" method="post">
            <div class="update-item">
                <span class="update-label">Change username</span>
                <input type="text" name="username" value = "<?=htmlentities($_SESSION[Session::USERNAME])?>">
            </div>
            <div class="update-item">
                <span class="update-label">Change name</span>
                <input type="text" name="name" value="<?=htmlentities($_SESSION[Session::NAME])?>">
            </div>
            <div class="update-item">
                <span class="update-label">Change e-mail</span>
                <input type="email" name="email" value="<?=htmlentities($_SESSION[Session::EMAIL])?>">
            </div>
            <div class="update-item">
                <input class="button" type="submit" value="Update">
            </div>
        </form>
        <form id="update-password" action = "../actions/updateUserPassword.php" method="post">
            <div class="update-item">
                <span class="update-label">Current password</span>
                <input class="password" type="password" name="curr-password" value="<?=$prevCurrPassword?>">
            </div>
            <div class="update-item">
                <span class="update-label">New password</span>
                <input class="password" type="password" name="password1" value="<?=$prevPassword1?>">
            </div>
            <div class="update-item">
                <span class="update-label">Confirm new password</span>
                <input class="password" type="password" name="password2" value="<?=$prevPassword2?>">
            </div>
            <div class="update-item">
                <input type="checkbox" onclick="toggleShowPasswords()">Show Passwords
            </div>
            <div class="update-item">
                <input class="button" type="submit" value="Update Password">
            </div>
        </form>
        <?php
            drawToasts($session);
        ?>
    </div>
</main>
<?php  
    drawFooter();
?>