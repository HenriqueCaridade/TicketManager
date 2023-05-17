<?php
    include_once("../templates/department.php");
    include_once("../database/connection.php");
    include_once("../classes/department.php");
    $db = getDatabaseConnection();
    $departments = Department::getAllDepartments($db);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/removeDepartment.php" method="post">
        <div class="popup-item">
            <span>Remove Department</span>
        </div>
        <div class="popup-item">
            <span>Department:</span>
            <?php drawDepartments($departments); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Delete</button>
        </div>
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>