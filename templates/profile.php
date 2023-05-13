<?php
    function drawProfile(?string $username, bool $showUsername=false, bool $showIcon=true) {
?>
<div class="profile" data-user="<?=htmlentities($username)?>">
<?php if ($showIcon) { ?>
<i class="fa-solid fa-circle-user"></i>
<?php } if ($showUsername) { ?>
    <span class="username"><?=htmlentities($username)?></span>
<?php } ?>
</div>
<?php
    }
?>