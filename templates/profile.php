<?php
    function drawProfile(?string $username=null, bool $showUsername=false, bool $showIcon=true) {
?>
<div <?php if ($username === null) { ?> id="profile" <?php } else { ?> data-user="<?=htmlentities($username)?>"  class="profile"<?php } ?>>
<?php if ($showIcon) { ?>
<i class="fa-solid fa-circle-user"></i>
<?php } if ($showUsername) { ?>
    <span class="username"><?=htmlentities($username)?></span>
<?php } ?>
</div>
<?php
    }
?>