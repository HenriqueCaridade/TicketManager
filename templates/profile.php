<?php
    function drawProfile(?string $username, bool $showUsername=false) {
?>
<div class="profile" data-user="<?=htmlentities($username)?>">
    <form class="other-profile-form" action="./index.php" method="get">
        <input type="hidden" name="page" value="account">
        <input type="hidden" name="username" value="<?=$username?>">
        <button type='submit' class="other-profile-submit">
            <i class="fa-solid fa-circle-user"></i>
        <?php if ($showUsername) { ?>
            <span class="username"><?=htmlentities($username)?></span>
        <?php } ?>
        </button>
    </form>
</div>
<?php
    }
?>