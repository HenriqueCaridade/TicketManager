<?php
    include_once('../templates/department.php');
    include_once('../database/connection.php');
    include_once('../classes/user.php');
    include_once('../classes/department.php');
    if (!isset($_POST['username'])) {
        var_dump($_POST);
        die();
    }
    $db = getDatabaseConnection();
    $agentDepartments = Department::getDepartmentsFromAgent($db, $_POST['username']);
    $departments = Department::getAllDepartments($db);
    $otherDepartments = array_filter($departments, fn($value) => !in_array($value, $agentDepartments));
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <div class="popup-item">
        <span><?=htmlentities($_POST['username'])?>'s Departments: </span>
    </div>
    <form action="../actions/addDepartmentToAgent.php" method="post">
        <div class="popup-item">
            <span>Add Department:</span>
            <?php drawDepartments($otherDepartments); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Add</button>
        </div>
        <input type="hidden" name='username' value="<?=htmlentities($_POST['username'])?>"> 
    </form>
    <form action="../actions/removeDepartmentFromAgent.php" method="post">
        <div class="popup-item">
            <span>Department</span>
            <?php drawDepartments($agentDepartments); ?>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Remove</button>
        </div>
        <input type="hidden" name='username' value="<?=htmlentities($_POST['username'])?>"> 
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>