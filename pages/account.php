<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/profile.php");
    // Session
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/user.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }

    $db = getDatabaseConnection();
    $username = $_POST['username'] ?? $_SESSION[Session::USERNAME];
    $user = User::getUser($db, $username);

    // Draw Page
    drawHeader(true);
    drawSidebar();
?>
<main class="main-sidebar">
    <div id="account" class="page">
        <h1 id="account-title" class="title">Account</h1>
        <div class='account-item'>
            <?php drawProfile($user->username) ?>
        </div>
        <div class="account-item">
            <?=htmlentities($user->username)?>
        </div>
        <div class="account-item">
            <?=htmlentities($user->name)?>
        </div>
        <div class="account-item">
            <?=htmlentities($user->email)?>
        </div>
        <div class="account-item">
            <?=htmlentities($user->userType)?>
        </div>
    </div>
</main>
<?php  
    drawFooter();
?>