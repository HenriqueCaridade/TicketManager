<?php
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    function _drawComment(TicketComment $comment, Session $session) { ?>

        <div class="comment">
            <div class="comment-header">
                <div class="comment-item"><?=htmlentities($comment->user)?></div>
                <div class="comment-item date">&nbsp;<?=htmlentities($comment->getFormattedDate())?></div>
                <?php if($session->getMyRights(User::USERTYPE_ADMIN) || $_SESSION[Session::USERNAME] === $comment->user){ ?>
                    <form class="comment-remove comment-item" action="./actions/removeComment.php" method="post">
                        <button type='submit'><i class="fa-solid fa-trash"></i></button>
                        <input type="hidden" name="commentId" value="<?=$comment->id?>">
                        <input type="hidden" name='ticketId' value="<?=$comment->ticketId?>">
                        <input type="hidden" name='csrf' value="<?=$session->getCSRF()?>">
                    </form>
                <?php } ?>
            </div>
            <div class="comment-text"> <?=$comment->text?></div>
        </div>
        <hr>
    <?php }
    function drawComments(Ticket $ticket, Session $session) { ?>
<div id="comments">
    <h1>Comments</h1>
    <form id="comment-add" action="./actions/addComent.php" method="post">
        <textarea name="text" placeholder="Your Comment..." maxlength="500" rows="4" required></textarea>
        <div class="big-button">
            <button id="comment-add-button" type="submit" class="submit-button">Comment</button>
        </div>
        <input type="hidden" name='ticketId' value="<?=$ticket->id?>">
        <input type="hidden" name='author' value="<?=$_SESSION[Session::USERNAME]?>">
        <input type="hidden" name='csrf' value="<?=$session->getCSRF()?>">
    </form>
    <?php foreach ($ticket->comments as $comment) _drawComment($comment, $session); ?>
</div>
<?php
    }
?>