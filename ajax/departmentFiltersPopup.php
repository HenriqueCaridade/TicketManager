<?php
    require_once(dirname(__DIR__) . "/templates/department.php");
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/preferences.php");
    require_once(dirname(__DIR__) . "/templates/priority.php");
    require_once(dirname(__DIR__) . "/templates/status.php");

    $session = Session::getSession();
    $db = getDatabaseConnection();
    $departments = Department::getAllDepartments($db);
    $preferences = Preferences::getPreferences($db, $_SESSION[Session::USERNAME]);
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form" >
    <form action="../actions/departmentFilters.php" method="post">
        <div id="popup-item-filter">
            <div class="popup-item-filter-item" id='filter-title'>By priority:</div>
            <div class="popup-item-filter-item" id="filter-normal">
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="priority1" value="Normal" <?php if($preferences->normal) {?>checked <?php }?>>
                <?php drawPriority('Normal');?>
            </div>
            <div class="popup-item-filter-item" id='filter-high'>
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="priority2" value="High" <?php if($preferences->high) {?>checked <?php }?>>
                <?php drawPriority('High');?>
            </div>
            <div class="popup-item-filter-item" id = "filter-urgent">
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="priority3" value="Urgent"<?php if($preferences->urgent) {?>checked <?php }?>>
                <?php drawPriority('Urgent');?>
            </div>
            <br>
            <div class="popup-item-filter-item" id='filter-title'>By status:</div>
            <div class="popup-item-filter-item" id="filter-unassigned">
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="status1" value="Unassigned"<?php if($preferences->unassigned) {?>checked <?php }?>>
                <?php drawStatus('Unassigned');?>
            </div>
            <div class="popup-item-filter-item" id='filter-progress' > 
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="status2" value="In progress"<?php if($preferences->inProgress) {?>checked <?php }?>>
                <?php drawStatus('In progress');?>
            </div>
            <div class="popup-item-filter-item" id='filter-done'>
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="status3" value="Done"<?php if($preferences->done) {?>checked <?php }?>>
                <?php drawStatus('Done');?>
            </div>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Submit</button>
        </div>
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>