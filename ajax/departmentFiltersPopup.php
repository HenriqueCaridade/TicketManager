<?php
    include_once("../templates/department.php");
    include_once("../database/connection.php");
    include_once("../classes/department.php");
    include_once("../classes/session.php");
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $departments = Department::getAllDepartments($db);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/departmentFilters.php" method="post">
        <input type="checkbox" name="priority1" value="Normal" <?php if($session->getFilter(Session::DEPARTMENT_PRIORITY1) !==null) {?>checked <?php }?>>
        <label for="priority1"> Normal</label><br>
        <input type="checkbox" name="priority2" value="High" <?php if($session->getFilter(Session::DEPARTMENT_PRIORITY2) !==null) {?>checked <?php }?>>
        <label for="priority2"> High</label><br>
        <input type="checkbox" name="priority3" value="Urgent"<?php if($session->getFilter(Session::DEPARTMENT_PRIORITY3 )!==null) {?>checked <?php }?>>
        <label for="priority3"> Urgent</label><br><br>
        <input type="submit" value="Submit">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>