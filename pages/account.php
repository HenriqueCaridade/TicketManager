<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    
    include_once("../classes/session.php");
    include_once("../classes/user.php");
    include_once("../database/connection.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $account = User::getUserInfo($db, $_POST['username']);

    // Draw Page
    drawHeader();
    drawSidebar();
?>
<main class="main-sidebar">
    <h1>ACCOUNT</h1>
</main>
<?php  
    drawFooter();
?>