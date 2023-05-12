<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
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
    <h1>Frequently Asked Questions (FAQ)</h1>
    <section class="faq">
        <div class="faq-item faq-collapsed" >
        <button class="faq-question">I can't login what should I do!?</button>
            <div class="faq-answer" >
                Contact one of the Admins!
            </div>
        </div>
        <div class="faq-item">
        <button class="faq-question">I don't remember my password</button>
            <div class="faq-answer">
                Contact one of the Admins!
            </div>
        </div>
    </section>
</main>
<?php  
    drawFooter();
?>