<?php
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/addDepartment.php" method="post">
        <div class="popup-item">
            <span>Add Department</span>
        </div>
        <div class="popup-item">
            <span>Name</span>
            <input type="text" name="name" minlength="5" required>
        </div>
        <div class="popup-item">
            <span>Abbreviation</span>
            <input type="text" name="abbrev" maxlength="10" required>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Add</button>
        </div>
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>