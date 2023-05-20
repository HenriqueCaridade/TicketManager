<?php
    function drawPriority(string $priority) {
?>
<div class="priority">
    <?php if ($priority === 'Normal') { ?>
        <i class="fa-solid fa-flag"style="color: dodgerblue"></i>
    <?php } else if ($priority === 'High') { ?>
        <i class="fa-solid fa-bolt" style="color: var(--warning-color)"></i>
    <?php } else if ($priority === 'Urgent') { ?>
        <i class="fa-solid fa-triangle-exclamation" style="color: var(--error-color)"></i>
    <?php } ?>  
    <span class="priority"><?=htmlentities($priority)?></span>
</div> <?php }?>