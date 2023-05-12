<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/faq.php");
    // Session
    include_once("../classes/session.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }

    // Draw Page
    drawHeader(true);
    drawSidebar();
?>
<main class="main-sidebar">
    <div id="faq" class="page">
        <h1 id="faq-title" class="title">Frequently Asked Questions (FAQ)</h1>
        <?php
            drawFAQ("I can't login what should I do?", "Contact one of the Admins!");
            drawFAQ("I don't remember my password", "Contact one of the Admins!");
        ?>
    </div>
</main>
<?php  
    drawFooter();
?>