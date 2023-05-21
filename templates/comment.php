<?php
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    function _drawComment(TicketComment $comment, Session $session) { ?>

        <div class="comment">
            <div class="comment-header">
                <div class="comment-item" id='user'><?= htmlentities($comment->user)  ?></div> 
                <div class="comment-item" id="publish-date">  &nbsp;commented at: <?= htmlentities($comment->date->format("H:i:s d-m-Y")) ?></div>
                <?php
                    if($session->getMyRights(User::USERTYPE_ADMIN) || $_SESSION[Session::USERNAME] === $comment->user ){
                        ?>
                        <form class="comment-remove comment-item" action="./actions/removeComment.php" method="post">
                            <input type="hidden" name="comment-id" value="<?= $comment->id?>">
                            <input type="hidden" name='ticket-id' value="<?=$comment->ticketId?>">
                            <button type='submit'><i class="fa-solid fa-trash"></i></button>
                        </form>
                <?php } ?>
            </div>
            
            <div class="comment-text"> <?= htmlentities($comment->text)  ?></div>
        </div>
        <hr>
    <?php }
    function drawComments(Ticket $ticket, Session $session) {
?>
<div id="comments">
    <h1>Comments</h1>
    <span>Add comment:</span>
    <form action="./actions/addComent.php" method="post">
        <textarea id="text" name="text" maxlength="250" required></textarea>
        <input type="hidden" name='ticket-id' value="<?=$ticket->id?>">
        <input type="hidden" name='author' value="<?=$_SESSION[Session::USERNAME]?>">
        <button type="submit" class="submit-button">Submit</button>
    </form>
        <?php
        foreach ($ticket->comments as $comment) _drawComment($comment, $session);
    ?>
    
</div>
<?php
    }
?>