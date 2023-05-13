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
    $db = getDatabaseConnection();
    // $ticket = Ticket::getTicket($db, $_POST['id']);


?>
<div id="ticket-page" class="page">
    <h1 id="ticket-page-title" class="title">Ticket <?=htmlentities($_POST['id'])?></h1>
</div>