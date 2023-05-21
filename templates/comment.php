<?php
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    function _drawComment(TicketComment $comment) {
        // TODO
        echo '<p>Comments TODO </p>';
    }
    function drawComments(array $comments) {
?>
<div id="comments">
<?php
        foreach ($comments as $comment) _drawComment($comment);
?>
</div>
<?php
    }
?>