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
    $query = $session->getSavedInput(Session::S_USER) ?? '';
    $clients = User::getClientsFiltered($db, $query);
    $agents = Agent::getAgentsFiltered($db, $query);

    // Draw Page
    drawHeader(true);
    drawSidebar($session, 'users');
?>
<main class="main-sidebar">
    <div class="page"> 
        <h1 class="title">Users</h1>
        <input id="user-search" type="search" placeholder="Search user..." value="<?=$query?>">
        <h1 class="admin-item">Clients</h1>
        <div id="client-table" class="admin-item"> <?php drawClients($clients); ?> </div>
        <h1 class="admin-item">Agents</h1>
        <div id="agent-table" class="admin-item"> <?php drawAgents($agents); ?> </div>
    </div>
    <div id='popup'></div>
</main>
<?php
    drawFooter();
?>