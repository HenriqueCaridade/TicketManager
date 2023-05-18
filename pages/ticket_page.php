<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/ticket.php");
    include_once("../templates/department.php");
    // Session
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/ticket.php");
    include_once("../classes/department.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    if (!isset($_POST['id'])) {
        die(header("Location: ../pages/dashboard.php"));
    }
    $db = getDatabaseConnection();
    $ticket = Ticket::getTicket($db, $_POST['id']);

    drawHeader(true);
    drawSidebar($session, 'NONE');
?>
<main class="main-sidebar">
    <div id="ticket-page" class="page">
        <h1 id="ticket-page-title" class="title"><?=htmlentities($ticket->subject)?></h1>
        <p><?php drawProfile($ticket->publisher, true)?></p>
        <p>Publish Date: <?=htmlentities($ticket->publishDate->format("H:i:s d-m-Y"))?></p>
        <p>Department: <?php if ($session->getRights(User::USERTYPE_AGENT)) { ?>
                <a class="ticket-department-change" data-id="<?=$ticket->id?>" data-department="<?=$ticket->department?>"> 
                    <?=htmlentities($ticket->department)?>
                </a>
            <?php } else { echo htmlentities($ticket->department); } ?>
        </p>
        <p>Text: <?=htmlentities($ticket->text)?></p>
        <p>Priority: <?=htmlentities($ticket->priority)?></p>
        <p>Status: <?=htmlentities($ticket->status->status)?></p>
    </div>
    <div id="popup"></div>
</main>
<?php
    drawFooter();
?>