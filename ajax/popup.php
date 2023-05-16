<?php
    include_once('../classes/user.php');
    if (!isset($_POST['username']) || !isset($_POST['userType'])) {
        echo '<p>failed</p>';
        die();
    }
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/client.php" method="post" class="client-form">
        <div class="popup-item">
            <span>Change <?=htmlentities($_POST['username'])?>'s UserType to: </span>
            <select name="userType" required>
                <option <?=$_POST['userType'] === User::USERTYPE_CLIENT ? 'selected' : ''?> value="Client">Client</option>
                <option <?=$_POST['userType'] === User::USERTYPE_AGENT ? 'selected' : ''?> value="Agent">Agent</option>
                <option <?=$_POST['userType'] === User::USERTYPE_ADMIN ? 'selected' : ''?> value="Admin">Admin</option>
            </select>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Submit</button>
            <button type="button" class="cancel-button" onclick="closePopup()">Close</button>
        </div>
        <input type="hidden" name = 'username' value="<?=htmlentities($_POST['username'])?>"> 
    </form>
</div>