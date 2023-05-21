<?php
    require_once(dirname(__DIR__) . "/templates/hashtag.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/hashtag.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    
    $db = getDatabaseConnection();
    $hashtags = Hashtag::getAllHashtags($db);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/removeHashtag.php" method="post">
        <div class="popup-item">
            <span>Remove Hashtag</span>
        </div>
        <div class="popup-item">
            <span>Hashtag:</span>
            <?php drawHashtags($hashtags); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Delete</button>
        </div>
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>