<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/sidebar.php");
    require_once(dirname(__DIR__) . "/templates/status.php");
    // Database
    require_once(dirname(__DIR__) . "/database/connection.php");
    // Session
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/ticketStatus.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ./index.php?page=login'));
    }

    function drawPage(array $getArray) {
        global $session;
        
        if (!isset($getArray['id'])) {
            die(header('Location: index.php?page=dashboard'));
        }

        
        $db = getDatabaseConnection();
        $ticket = Ticket::getTicket($db, intval($getArray['id']));
        
        drawHeader();
        drawSidebar($session);
?>
<main class="main-sidebar">
    <div class="page">
        <?php drawTicketStatuses($ticket->statuses); ?>
    </div>
</main>
<?php
        drawFooter();
    }
?>