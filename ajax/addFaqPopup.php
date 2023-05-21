<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/addFaq.php" method="post">
        <div class="popup-item">
            <span>Add FAQ</span>
        </div>
        <div class="popup-item">
            <span>Question</span>
            <input type="text" name="question" minlength="5" required>
        </div>
        <div class="popup-item">
            <span>Answer</span>
            <input type="text" name="answer" minlength="5" required>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Add</button>
        </div>
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>