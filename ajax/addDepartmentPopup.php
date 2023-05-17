
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
            <input type="text" name="abbrev" maxlength="5" required>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Add</button>
        </div>
    </form>
    <button type="button" class="red" onclick="closePopup()">Close</button>
</div>