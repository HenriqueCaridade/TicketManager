<?php
    require_once(dirname(__DIR__) . "/classes/ticketStatus.php");

    function _drawTicketStatus(TicketStatus $status) {
        // TODO
        echo '<p>Status TODO </p>';
    }

    function drawTicketStatuses(array $statuses){
        foreach ($statuses as $status) _drawTicketStatus($status);
    }

    function drawStatus(string $status, ?string $agentUsername=null) {
        $statusStr = $status;
?>
<div class="status">
    
    <?php if ($status === TicketStatus::UNASSIGNED) { ?>
        <i class="fa-solid fa-circle-xmark" style="color: gray;"></i> 
    <?php } else if ($status === TicketStatus::ASSIGNED) { ?>
        <i class="fa-solid fa-list-check" style="color: dodgerblue"></i>
        <?php if ($agentUsername !== null) $statusStr .= " to " . $agentUsername;?>
    <?php } else if ($status === TicketStatus::DONE) { ?>
        <i class="fa-solid fa-circle-check" style="color: var(--success-color);"></i>
        <?php if ($agentUsername !== null) $statusStr .= " by " . $agentUsername;?>
    <?php } ?>    
    <span class="status"><?=htmlentities($statusStr)?></span>
</div>
<?php } ?>
