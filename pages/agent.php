<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");

    // Session
    include_once("../database/connection.php");

    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }

    // Draw Page
    drawHeader(true);
    drawSidebar($session);
?>
    <main class="main-sidebar">

    </main>
<?php
    drawFooter();
?>