<?php
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    function _drawComment(TicketComment $comment) { ?>
        <div class="comment">
            <div class="comment-header">
                <div class="comment-item" id='user'><?= htmlentities($comment->user) ?></div> </p> 
                <div class="comment-item"><?= $comment->date->format("H:i:s d-m-Y") ?></div> </p> 
            </div>
            <div class="comment-text"><?= htmlentities($comment->text)  ?></div> </p> 
        </div>
        
    <?php }
    function drawComments(Ticket $ticket) {
?>
<div id="comments">
    <h1>Comments</h1>
    <span>Add comment:</span>
    <form action="./actions/addComent.php" method="post">
        <input type="text" name="text" required>
        <input type="hidden" name='ticket-id' value="<?=$ticket->id?>">
        <input type="hidden" name='author' value="<?=$_SESSION[Session::USERNAME]?>">
        <button type="submit" class="submit-button">Submit</button>
    </form>
        <?php
        foreach ($ticket->comments as $comment) _drawComment($comment);
    ?>
    
</div>
<?php
    }
?>