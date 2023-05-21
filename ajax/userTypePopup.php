<?php
    require_once(dirname(__DIR__) . "/classes/user.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    $session = Session::getSession();
    
    if (!isset($_POST['username']) || !isset($_POST['userType'])) {
        echo '<p> An Error occurred! </p>';
        die();
    }
?>
<div id="popup-darken" onclick="closePopup()"></div>
<div id="popup-form">
    <form action="../actions/changeUserType.php" method="post">
        <div class="popup-item">
            <span><?=htmlentities($_POST['username'])?>'s User Type: </span>
            <select name="userType" required>
                <option <?=$_POST['userType'] === User::USERTYPE_CLIENT ? 'selected' : ''?> value="Client">Client</option>
                <option <?=$_POST['userType'] === User::USERTYPE_AGENT ? 'selected' : ''?> value="Agent">Agent</option>
                <option <?=$_POST['userType'] === User::USERTYPE_ADMIN ? 'selected' : ''?> value="Admin">Admin</option>
            </select>
        </div>
        <div class="popup-item">
            <button type="submit" class="submit-button">Submit</button>
        </div>
        <input type="hidden" name='username' value="<?=htmlentities($_POST['username'])?>"> 
        <button type="button" class="red" onclick="closePopup()">Close</button>
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    </form>
</div>