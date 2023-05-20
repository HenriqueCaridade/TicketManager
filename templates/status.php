<?php
    function drawStatus(string $status) {
?>
<div class="status">
    <?php if($status === 'Unassigned'){
        ?>
        <i class="fa-regular fa-circle-xmark" style="color: gray;"></i> 
    <?php }
    else if($status === 'In progress') {?>
        <i class="fa-solid fa-spinner" style="color: orange"></i> 
    <?php }
    else if($status ==='Done') {?>
        <i class="fa-regular fa-circle-check" style =" color: green;"></i> 
    <?php } ?>  
        <span class="status"><?=htmlentities($status)?></span>
</div> <?php }?>