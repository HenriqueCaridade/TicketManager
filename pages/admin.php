<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/user.php");
    include_once("../database/connection.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    $clients = User::getAllClients($db);
    $agents = Agent::getAllAgents($db);

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }

    // Draw Page
    drawHeader(true);
    drawSidebar($session);
?>
<main class="main-sidebar">
    <div class="page"> 
        <h1 class="admin-item">Manage clients</h1>
        <div class="admin-item client-table"> <?php drawClients($clients); ?> </div>
        <h1 class="admin-item">Manage agents</h1>
        <div class="admin-item agent-table"> <?php drawAgents($agents); ?> </div>
        <div id='popup'></div>
    </div>
</main>
<?php
    drawFooter();
?>