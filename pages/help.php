<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    // Session
    include_once("../classes/session.php");
    $session = Session::getSession();

    // Draw Page
    drawHeader();
    drawSidebar();
?>
<main class="main-sidebar">
    <h1>HELP</h1>
</main>
<?php  
    drawFooter();
?>