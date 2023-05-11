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
    <section class="FAQ">
        <div class="FAQ_Item">
        <button class="FAQ_question" id="question1">I can't login what should I do!?</button>
            <div class="FAQ_Answer" id="answer1">
                Contact one of the Admins!
            </div>
        </div>
        <div class="FAQ_Item">
        <button class="FAQ_question" id="question2">I don't remember my password</button>
            <div class="FAQ_Answer" id="answer2">
                Contact one of the Admins!
            </div>
        </div>
    </section>
</main>
<?php  
    drawFooter();
?>