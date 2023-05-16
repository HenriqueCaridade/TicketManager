<?php
    include_once("../templates/profile.php");
    include_once("../classes/ticket.php");
    include_once("../classes/department.php");
    function _drawDepartment(Department $department) {
?>
    <option value = '<?=htmlentities($department->name)?>'> <?=htmlentities($department->name)?></option>
<?php
    }

    function drawDepartments(array $departments) {
?>
<select name="department">
    <?php
    foreach ($departments as $department) {
        _drawDepartment($department);
    }
    ?>
</select>
<?php
    }
?>