<?php
    include_once("../classes/ticket.php");
    include_once("../templates/profile.php");
    function drawTicket(Ticket $ticket) {
?>
<div class="ticket">
    <?php drawProfile($ticket->publisher, true); ?>
    <div class="ticket-middle">
        <span class="ticket-text"><?=htmlentities($ticket->text)?></span>
        <span class="ticket-department"><?=htmlentities($ticket->department)?></span>
    </div>
    <div class="ticket-priority <?=htmlentities(strtolower($ticket->priority))?>"><?=htmlentities($ticket->priority)?></div>
    <div class="ticket-status <?=htmlentities(strtolower($ticket->status->status))?>"><?=htmlentities($ticket->status->status)?></div>
</div>
<?php
    }

    function drawTickets(array $tickets) {
        foreach ($tickets as $ticket) {
            drawTicket($ticket);
        }
    }
?>