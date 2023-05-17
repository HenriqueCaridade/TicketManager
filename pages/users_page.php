<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/user.php");
    include_once("../database/connection.php");

    $session = Session::getSession();
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    $db = getDatabaseConnection();
    $clients = User::getAllClients($db);
    $agents = Agent::getAllAgents($db);

    // Draw Page
    drawHeader(true);
    drawSidebar($session, 'users');
?>
<main class="main-sidebar">
    <div class="page"> 
        <h1 class="title">Users</h1>
        <input id="user-search" type="text">
        <button id="user-filters"><i class="fa-solid fa-filter"></i></button>
        <h1 class="admin-item">Manage clients</h1>
        <div class="admin-item client-table"> <?php drawClients($clients); ?> </div>
        <h1 class="admin-item">Manage agents</h1>
        <div class="admin-item agent-table"> <?php drawAgents($agents); ?> </div>
    </div>
    <div id='popup'></div>
</main>
<?php
    drawFooter();
?>