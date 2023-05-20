<?php
    require_once(dirname(__DIR__) . "/classes/ticketStatus.php");

    function _drawTicketStatus(TicketStatus $status) {
        // TODO
        echo '<p>Status TODO </p>';
    }

    function drawTicketStatuses(array $statuses){
        foreach ($statuses as $status) _drawTicketStatus($status);
    }

    function drawStatus(string $status) {
?>
<div class="status">
    <?php if($status === 'Unassigned'){
        ?>
        <i class="fa-solid fa-circle-xmark" style="color: gray;"></i> 
    <?php }
    else if($status === 'In progress') {?>
        <i class="fa-solid fa-list-check" style="color: dodgerblue"></i> 
    <?php }
    else if($status ==='Done') {?>
        <i class="fa-solid fa-circle-check" style =" color: var(--success-color);"></i> 
    <?php } ?>  
        <span class="status"><?=htmlentities($status)?></span>
</div> <?php }
?>
