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
        <div class="popup-item filter-item">
            <input class="filter-item" type="checkbox" name="priority1" value="Normal" <?php if($preferences->normal) {?>checked <?php }?>>
            <label class="filter-item" for="priority1"> Normal</label>
        </div>
        <div class="popup-item filter-item">
            <input class="filter-item" type="checkbox" name="priority2" value="High" <?php if($preferences->high) {?>checked <?php }?>>
            <label class="filter-item" for="priority2"> High</label>
        </div>
        <div class="popup-item filter-item">
            <input class="filter-item" type="checkbox" name="priority3" value="Urgent"<?php if($preferences->urgent) {?>checked <?php }?>>
            <label class="filter-item" for="priority3"> Urgent</label>
        </div>
        <div class="popup-item filter-item">
            <input class="filter-item" type="checkbox" name="status1" value="Unassigned"<?php if($preferences->unassigned) {?>checked <?php }?>>
            <label class="filter-item" for="status1"> Unassigned</label>
        </div>
        <div class="popup-item filter-item">
            <input class="filter-item" type="checkbox" name="status2" value="In progress"<?php if($preferences->inProgress) {?>checked <?php }?>>
            <label class="filter-item" for="status2"> In progress</label>
        </div>
        <div class="popup-item filter-item">
            <input class="filter-item" type="checkbox" name="status3" value="Done"<?php if($preferences->done) {?>checked <?php }?>>
            <label class="filter-item" for="status3"> Done</label>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Submit</button>
        </div>
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>