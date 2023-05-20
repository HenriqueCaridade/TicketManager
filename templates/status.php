<?php
    require_once(dirname(__DIR__) . "/classes/ticketStatus.php");

    function _drawStatus(TicketStatus $status) {
        // TODO
        echo '<p>Status TODO </p>';
    }

    function drawStatuses(array $statuses){
        foreach ($statuses as $status) _drawStatus($status);
    }
?>