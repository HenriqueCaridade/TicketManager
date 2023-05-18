<?php
    include_once("../classes/ticket.php");
    include_once("../templates/profile.php");
    function _drawTicket(Ticket $ticket) {
?>
<tr class="ticket">
    <td class="ticket-username"><?php drawProfile($ticket->publisher, true); ?></td>
    <td class="ticket-subject"><?=htmlentities($ticket->subject)?></td>
    <td class="ticket-department"><?=htmlentities($ticket->department)?></td>
    <td class="ticket-priority"><?=htmlentities($ticket->priority)?></td>
    <td class="ticket-status"><?=htmlentities($ticket->status->status)?></td>
    <td class="ticket-edit">
        <form class="ticket-page-form" action="../pages/ticket_page.php" method="post">
            <input type="hidden" name="id" value="<?=$ticket->id?>">
            <button type='submit' class="ticket-page-submit">See Ticket</button>
        </form>
    </td>
</tr>
<?php
    }

    function drawTickets(array $tickets) {
?>
<table id="tickets">
    <thead>
        <tr>
            <th>User</th>
            <th>Ticket</th>
            <th>Department</th>
            <th>Priority</th>
            <th>Status</th>
            <th style="width: 0;">See Ticket</th>
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
    function _drawTicketDepartment(Ticket $ticket) {
        ?>
        <tr class="ticket">
            <td class="ticket-username"><?php drawProfile($ticket->publisher, true); ?></td>
            <td class="ticket-subject"><?=htmlentities($ticket->subject)?></td>
            <td class="ticket-priority"><?=htmlentities($ticket->priority)?></td>
            <td class="ticket-status"><?=htmlentities($ticket->status->status)?></td>
            <td class="ticket-edit">
                <form class="ticket-page-form" action="../pages/ticket_page.php" method="post">
                    <input type="hidden" name="id" value="<?=$ticket->id?>">
                    <button type='submit' class="ticket-page-submit">See Ticket</button>
                </form>
            </td>
        </tr>
        <?php
            }
    function drawTicketsDepartment(array $tickets) {
        ?>
        <table id="tickets">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Ticket</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th style="width: 0;">See Ticket</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tickets as $ticket) {
                _drawTicketDepartment($ticket);
            }
            ?>
            </tbody>
        </table>
        <?php
            }
?>