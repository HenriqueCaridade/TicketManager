<?php
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    function _drawComment(TicketComment $comment) {
        // TODO
        echo '<p>Comments TODO </p>';
    }
    function drawComments(array $comments) {
        foreach ($comments as $comment) _drawComment($comment);
    }
?>