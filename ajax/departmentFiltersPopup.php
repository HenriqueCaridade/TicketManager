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
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="priority1" value="<?=TicketStatus::NORMAL?>" <?php if($preferences->normal) {?>checked <?php }?>>
                <?php drawPriority(TicketStatus::NORMAL);?>
            </div>
            <div class="popup-item-filter-item" id='filter-high'>
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="priority2" value="<?=TicketStatus::HIGH?>" <?php if($preferences->high) {?>checked <?php }?>>
                <?php drawPriority(TicketStatus::HIGH);?>
            </div>
            <div class="popup-item-filter-item" id = "filter-urgent">
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="priority3" value="<?=TicketStatus::URGENT?>"<?php if($preferences->urgent) {?>checked <?php }?>>
                <?php drawPriority(TicketStatus::URGENT);?>
            </div>
            <br>
            <div class="popup-item-filter-item" id='filter-title'>By status:</div>
            <div class="popup-item-filter-item" id="filter-unassigned">
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="status1" value="<?=TicketStatus::UNASSIGNED?>"<?php if($preferences->unassigned) {?>checked <?php }?>>
                <?php drawStatus(TicketStatus::UNASSIGNED);?>
            </div>
            <div class="popup-item-filter-item" id='filter-progress' > 
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="status2" value="<?=TicketStatus::ASSIGNED?>"<?php if($preferences->assigned) {?>checked <?php }?>>
                <?php drawStatus(TicketStatus::ASSIGNED);?>
            </div>
            <div class="popup-item-filter-item" id='filter-done'>
                <input class="filter-item" id="filter-checkmark" type="checkbox" name="status3" value="<?=TicketStatus::DONE?>"<?php if($preferences->done) {?>checked <?php }?>>
                <?php drawStatus(TicketStatus::DONE);?>
            </div>
            <br>
            <div class="popup-item-filter-item" id='filter-title'>By date:</div>
            <div class="popup-item-filter-item" >
                <span>From:</span>
                <br>
                <input class="filter-item" id="filter-date" type="datetime-local" name="dateFrom" value = "<?= Preferences::DatetimeTodatetimeLocal($preferences->from);?>" min="1900-01-01T00:00" max="2030-01-01T00:00">
            </div>
            <div class="popup-item-filter-item" >
                <span>To:</span>
                <br>
                <input class="filter-item" id="filter-date" type="datetime-local" name="dateTo" value = "<?= Preferences::DatetimeTodatetimeLocal($preferences->to);?>" min="1900-01-01T00:00" max="2050-01-01T00:00">
            </div>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Submit</button>
        </div>
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>