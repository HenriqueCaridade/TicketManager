<?php
    require_once(dirname(__DIR__) . "/templates/department.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    
    $db = getDatabaseConnection();
    $departments = Department::getAllDepartments($db);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <div class="popup-item">
        <span> Ticket ID: <?=htmlentities($_POST['id'])?></span>
    </div>
    <form action="../actions/changeTicketDepartment.php" method="post">
        <div class="popup-item">
            <span>Department</span>
            <?php drawDepartments($departments, $_POST['department']); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Change</button>
        </div>
        <input type="hidden" name='id' value="<?=htmlentities($_POST['id'])?>">
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>