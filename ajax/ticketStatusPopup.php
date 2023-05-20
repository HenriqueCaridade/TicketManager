<?php
    require_once(dirname(__DIR__) . "/templates/status.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    $db = getDatabaseConnection();
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <div class="popup-item">
        <span> Ticket ID: <?=htmlentities($_POST['id'])?></span>
    </div>
    <form action="../actions/changeTicketStatus.php" method="post">
        <div class="popup-item">
            
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Change</button>
        </div>
        <input type="hidden" name='id' value="<?=htmlentities($_POST['id'])?>"> 
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>