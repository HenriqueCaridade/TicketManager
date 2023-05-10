<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/toast.php");
    include_once("../classes/user.php");
    
    // Session
    include_once("../classes/session.php");
    $session = Session::getSession();
    // Draw Page
    drawHeader();
    drawSidebar();
?>
<main class="main-sidebar">
<h1 id="register-title" class="register">Manage personal information</h1>
    <form id="updateInfo" action="../actions/updateUserSettings.php" method="post">
        <div class="register-item">
            <span class="register-label">Change username</span>
            <input type="text" name="username" value = "<?= $_SESSION[Session::USERNAME]?>">
        </div>
        <div class="register-item">
            <span class="register-label">Change name</span>
            <input type="text" name="name" value="<?= $_SESSION[Session::NAME]?>">
        </div>
        <div class="register-item">
            <span class="register-label">Change e-mail</span>
            <input type="email" name="email"value="<?= $_SESSION[Session::EMAIL]?>">
        </div>
        <div class="register-item">
            <input class="button" type="submit" value="Update">
        </div>
    </form>
    <form id="updatePassword" action = "../actions/updateUserPassword.php" method="post"> 
        <div class="register-item">
            <span class="register-label">New password</span>
            <input type="password" name="password1">
        </div>
        <div class="register-item">
            <span class="register-label">Confirm new password</span>
            <input type="password" name="password2">
        </div>
        <div class="register-item">
            <input class="button" type="submit" value="Update Password">
        </div>
    </form>
    <?php
        drawToasts($session);
    ?>
</main>
<?php  
    drawFooter();
?>