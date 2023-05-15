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
    $agents = User::getAllAgents($db);

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
            <h1>Manage clients</h1>
            <div class="client-table"> <?php drawClients($clients); ?> </div>
            
            <br>
            <h1>Manage agents</h1>
            <div class="agent-table"> <?php drawAgents($agents); ?> </div>
            <div id="popup-darken" onclick="closeClientPopup()"></div>
            <div id="popup-form">
                <form action="../actions/client.php" method="post" class="client-form">
                    <div>
                        <span>Change <?=htmlentities() ?>'s UserType to: </span>
                        <select name="usertype" value ="<?=htmlentities() ?>" required>
                            <option value="Client">Client</option>
                            <option value="Agent">Agent</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="submit-button">Submit</button>
                        <button type="button" class="cancel-button" onclick="closeClientPopup()">Close</button>
                    </div>
                    <input type="hidden" name = 'username' value="<?=htmlentities() ?>"> 
                </form>
            </div>
        </div>
    </main>
<?php
    drawFooter();
?>