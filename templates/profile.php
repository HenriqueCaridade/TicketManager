<?php
    function drawProfile(?string $username=null, bool $showUsername=false) {
?>
<div id="profile" <?php if ($username !== null) { ?> data-user="<?=htmlentities($username)?>"> <?php } ?>
    <i class="fa-solid fa-circle-user"></i>
<?php if ($showUsername) { ?>
    <span class="username"><?=htmlentities($username)?></span>
<?php } ?>
</div>
<?php
    }
?>