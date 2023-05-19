<?php
    include_once("../templates/department.php");
    include_once("../database/connection.php");
    include_once("../classes/department.php");
    include_once("../classes/session.php");
    include_once("../classes/preferences.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    $departments = Department::getAllDepartments($db);
    $preferences = Preferences::getPreferences($db, $_SESSION[Session::USERNAME]);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/departmentFilters.php" method="post">
        <input type="checkbox" name="priority1" value="Normal" <?php if($preferences->normal) {?>checked <?php }?>>
        <label for="priority1"> Normal</label><br>
        <input type="checkbox" name="priority2" value="High" <?php if($preferences->high) {?>checked <?php }?>>
        <label for="priority2"> High</label><br>
        <input type="checkbox" name="priority3" value="Urgent"<?php if($preferences->urgent) {?>checked <?php }?>>
        <label for="priority3"> Urgent</label><br><br>
        <input type="submit" value="Submit">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>