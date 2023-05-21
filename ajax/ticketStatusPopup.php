<?php
    require_once(dirname(__DIR__) . "/templates/status.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    $db = getDatabaseConnection();
    $ticket = Ticket::getTicket($db, $_POST['id']);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <div class="popup-item">
        <span> Ticket ID: <?=$ticket->id?></span>
    </div>
    <?php if ($ticket->status === Ticket::DONE) { ?>
        <form action="../actions/changeTicketStatus.php" method="post">
            <button type="submit" class="submit-button" style="background-color: dodgerblue; margin-block-end: 0.5em;">Mark as Undone</button>
            <input type="hidden" name='action' value="Undone"> 
            <input type="hidden" name='id' value="<?=$ticket->id?>"> 
        </form>
    <?php } else { ?>
        <form action="../actions/changeTicketStatus.php" method="post">
            <div class="popup-item">
                <input type="text" name="username" placeholder="Leave blank to unassign..." value="<?=$ticket->agentUsername ?? ""?>">
            </div>
            <div class="popup-item">
                <button type="submit" class="submit-button">Change</button>
            </div>
            <input type="hidden" name='action' value="Assign"> 
            <input type="hidden" name='id' value="<?=$ticket->id?>"> 
        </form>
        <?php if ($ticket->status === Ticket::ASSIGNED) { ?>
            <form action="../actions/changeTicketStatus.php" method="post">
                <button type="submit" class="submit-button" style="background-color: var(--success-color); margin-block-end: 0.5em;">Mark as Done</button>
                <input type="hidden" name='action' value="Done">
                <input type="hidden" name='id' value="<?=$ticket->id?>"> 
            </form>
        <?php } ?>
    <?php } ?>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>