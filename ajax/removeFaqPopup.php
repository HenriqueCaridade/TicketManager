<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/faq.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/templates/faq.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    $faqs = FAQ::getAll($db);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/removeFaq.php" method="post">
        <div class="popup-item">
            <span>Remove a FAQ</span>
        </div>
        <div class="popup-item">
            <span>FAQ ID</span>
            <?= _drawFAQs($faqs) ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Remove</button>
        </div>
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>