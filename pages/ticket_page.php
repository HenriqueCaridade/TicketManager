<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/sidebar.php");
    require_once(dirname(__DIR__) . "/templates/ticket.php");
    require_once(dirname(__DIR__) . "/templates/department.php");
    require_once(dirname(__DIR__) . "/templates/comment.php");
    require_once(dirname(__DIR__) . "/templates/toast.php");
    // Database
    require_once(dirname(__DIR__) . "/database/connection.php");
    // Classes
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    // Session
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

        // Draw Page
        drawHeader();
        drawSidebar($session);
?>
<main class="main-sidebar">
    <div id="ticket-page" class="page">
        <h1 id="ticket-page-title" class="title"><?=htmlentities($ticket->subject)?><span id="ticket-page-id">#<?=htmlentities($ticket->id)?></span></h1>
        <div class="ticket-item">
            <span class="ticket-label">Publisher</span>
            <div class="ticket-box"><?=htmlentities($ticket->publisher)?></div>
            <form class="user-page-form option" action="./index.php" method="get">
                <input type="hidden" name="page" value="account">
                <input type="hidden" name="username" value="<?=$ticket->publisher?>">
                <button type='submit' class="user-page-submit">See User...</button>
            </form>
        </div>
        <div class="ticket-item">
            <span class="ticket-label">Publish Date</span>
            <div class="ticket-box"><?=htmlentities($ticket->date->format("H:i:s d-m-Y"))?></div>
        </div>
        <div class="ticket-item">
            <span class="ticket-label">Department</span>
            <div class="ticket-box"><?=htmlentities($ticket->department)?></div>
            <?php if ($session->getMyRights(User::USERTYPE_AGENT)) { ?>
                <a class="ticket-department-change option" data-id="<?=$ticket->id?>" data-department="<?=$ticket->department?>"> 
                    Change...
                </a>
            <?php } ?>
        </div>
        <div class="ticket-item">
            <span class="ticket-label">Priority</span>
            <div class="ticket-box"><?php drawPriority($ticket->priority); ?></div>
            <?php if ($session->getMyRights(User::USERTYPE_AGENT)) { ?>
                <a class="ticket-priority-change option" data-id="<?=$ticket->id?>" data-priority="<?=$ticket->priority?>"> 
                    Change...
                </a>
            <?php } ?>
        </div>
        <div class="ticket-item">
            <span class="ticket-label">Status</span>
            <div class="ticket-box"><?php drawStatus($ticket->status, $ticket->agentUsername); ?></div>
            <?php if ($session->getMyRights(User::USERTYPE_AGENT)) { ?>
                <a class="ticket-status-change option" data-id="<?=$ticket->id?>" data-status="<?=$ticket->status?>"> 
                    Change...
                </a>
            <?php } ?>
        </div>
        <div class="ticket-item">
            <span class="ticket-label">Hashtags</span>
            <div class="ticket-box"><?=htmlentities($ticket->hashtagString); ?></div>
            <?php if ($session->getMyRights(User::USERTYPE_AGENT)) { ?>
                <a class="ticket-hashtag-change option" data-id="<?=$ticket->id?>"> 
                    Change...
                </a>
            <?php } ?>
        </div>
        <div class="ticket-item">
                <form class="ticket-page-form " action="./index.php" method="get">
                    <input type="hidden" name="page" value="ticket-history">
                    <input type="hidden" name="id" value="<?=$ticket->id?>">
                    <button type='submit' class="ticket-page-submit">View Ticket History...</button>
                </form>
        </div>
        <?php drawToasts($session); ?>
        <hr>
        <p><?=htmlentities($ticket->text)?></p>
        <hr>
        <?php drawComments($ticket, $session) ?>
    </div>
    <div id="popup"></div>
</main>
<?php
        drawFooter();
    }
?>