<?php
    require_once(dirname(__DIR__) . "/templates/hashtag.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    
    if (!isset($_POST['id'])) {
        $session->addToast(Session::ERROR, 'Missing parameters.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    $db = getDatabaseConnection();
    $ticketHashtags = Hashtag::getHastagsFromTicket($db, $_POST['id']);
    $hashtags = Hashtag::getAllHashtags($db);
    $otherHashtags = array_filter($hashtags, fn($value) => !in_array($value, $ticketHashtags));
?> 
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <div class="popup-item">
        <span>Ticket <?=htmlentities($_POST['id'])?>'s Hashtags: </span>
    </div>
    <form action="../actions/addHashtagToTicket.php" method="post">
        <div class="popup-item">
            <span>Add Hashtag</span>
            <?php drawHashtags($otherHashtags); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Add</button>
        </div>
        <input type="hidden" name='id' value="<?=htmlentities($_POST['id'])?>"> 
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <form action="../actions/removeHashtagFromTicket.php" method="post">
        <div class="popup-item">
            <span>Remove Hashtag</span>
            <?php drawHashtags($ticketHashtags); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Remove</button>
        </div>
        <input type="hidden" name='id' value="<?=htmlentities($_POST['id'])?>"> 
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>