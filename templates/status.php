<?php
    require_once(dirname(__DIR__) . "/templates/priority.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/ticketChange.php");

    function _drawTicketChange(TicketChange $change) {
    ?>
    <div class="ticket-history-change">
        <div class="ticket-history-info">
            <?php switch($change->type) {
            case TicketChange::DEPARTMENT: ?>
                <span class="ticket-history-before"><?=htmlentities($change->oldVal); ?></span>
                <i class="fa-solid fa-arrow-right-long"></i>
                <span class="ticket-history-after"><?=htmlentities($change->newVal); ?></span>
            <?php break;
            case TicketChange::PRIORITY: ?>
                <span class="ticket-history-before"><?php drawPriority($change->oldVal); ?></span>
                <i class="fa-solid fa-arrow-right-long"></i>
                <span class="ticket-history-after"><?php drawPriority($change->newVal); ?></span>    
            <?php break;
            case TicketChange::STATUS:
                if ($change->oldVal === 'Not Done' && $change->newVal === 'Done') {
                    $oldVal = Ticket::ASSIGNED; $newVal = Ticket::DONE;
                } else {
                    $oldVal = Ticket::DONE; $newVal = Ticket::ASSIGNED;
                }?>
                <span class="ticket-history-before"><?php drawStatus($oldVal); ?></span>
                <i class="fa-solid fa-arrow-right-long"></i>
                <span class="ticket-history-after"><?php drawStatus($newVal); ?></span>
            <?php break;
            case TicketChange::ASSIGN:
                if ($change->oldVal === null && $change->newVal !== null) {
                    $oldVal = Ticket::UNASSIGNED; $newVal = Ticket::ASSIGNED;
                } else if ($change->oldVal !== null && $change->newVal === null) {
                    $oldVal = Ticket::ASSIGNED; $newVal = Ticket::UNASSIGNED;
                } else {
                    $oldVal = Ticket::ASSIGNED; $newVal = Ticket::ASSIGNED;
                }?>
                <span class="ticket-history-before"><?php drawStatus($oldVal, $change->oldVal ?? "None"); ?></span>
                <i class="fa-solid fa-arrow-right-long"></i>
                <span class="ticket-history-after"><?php drawStatus($newVal, $change->newVal ?? "None"); ?></span>
            <?php } ?>
        </div>
        <span class="ticket-history-date"><?=htmlentities($change->getFormattedDate())?></span>
    </div>
    <?php
    }

    function drawTicketChanges(array $statuses){
        foreach ($statuses as $status) _drawTicketChange($status);
    }

    function drawStatus(string $status, ?string $agentUsername=null) {
        $statusStr = $status;
?>
<div class="status">
    
    <?php if ($status === Ticket::UNASSIGNED) { ?>
        <i class="fa-solid fa-circle-xmark" style="color: gray;"></i> 
    <?php } else if ($status === Ticket::ASSIGNED) { ?>
        <i class="fa-solid fa-list-check" style="color: dodgerblue"></i>
        <?php if ($agentUsername !== null) $statusStr .= " to " . $agentUsername;?>
    <?php } else if ($status === Ticket::DONE) { ?>
        <i class="fa-solid fa-circle-check" style="color: var(--success-color);"></i>
        <?php if ($agentUsername !== null) $statusStr .= " by " . $agentUsername;?>
    <?php } ?>    
    <span class="status"><?=htmlentities($statusStr)?></span>
</div>
<?php } ?>
