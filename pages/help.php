<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/faq.php");
    // Database
    include_once("../database/connection.php");
    // Classes
    include_once("../classes/session.php");
    include_once("../classes/faq.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    $db = getDatabaseConnection();
    $faqs = FAQ::getAll($db);

    // Draw Page
    drawHeader(true);
    drawSidebar();
?>
<main class="main-sidebar">
    <div id="faq" class="page">
        <h1 id="faq-title" class="title">Frequently Asked Questions (FAQ)</h1>
        <?php
            foreach ($faqs as $faq) drawFAQ($faq->question, $faq->answer);
        ?>
    </div>
</main>
<?php  
    drawFooter();
?>