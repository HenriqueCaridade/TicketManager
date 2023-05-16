<?php
    include_once("../classes/ticket.php");
    include_once("../templates/profile.php");
    function _drawTicket(Ticket $ticket) {
?>
<tr class="ticket" >
    <td class="ticket-username"><?php drawProfile($ticket->publisher, true); ?></td>
    <td class="ticket-subject"><?=htmlentities($ticket->subject)?></td>
    <td class="ticket-department">
        <a class="ticket-department-change" data-id="<?=$ticket->id?>" data-department="<?=$ticket->department?>"> 
            <?=htmlentities($ticket->department)?> 
        </a>
    </td>
    <td class="ticket-priority"><?=htmlentities($ticket->priority)?></td>
    <td class="ticket-status"><?=htmlentities($ticket->status->status)?></td>
</tr>
<?php
    }

    function drawDepartmentTickets(string $departmentName, $tickets) {
?>
<h1> <?= htmlentities($departmentName); ?></h1>
<table id="department-tickets">
    <thead>
        <tr>
            <th>User</th>
            <th>Ticket</th>
            <th>Department</th>
            <th>Priority</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($tickets as $ticket) {
        _drawTicket($ticket);
    }
    ?>
    </tbody>
</table>
<?php
    }
?>