<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/sidebar.php");
    require_once(dirname(__DIR__) . "/templates/user.php");
    // Database
    require_once(dirname(__DIR__) . "/database/connection.php");
    // Classes
    require_once(dirname(__DIR__) . "/classes/session.php");
    // Session
    $session = Session::getSession();
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ./index.php?page=login'));
    }

    function drawPage(array $getArray) {
        global $session;

        $db = getDatabaseConnection();
        $query = $session->getSavedInput(Session::S_USER) ?? '';
        $clients = User::getClientsFiltered($db, $query);
        $agents = Agent::getAgentsFiltered($db, $query);

        // Draw Page
        drawHeader($session);
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
    }
?>