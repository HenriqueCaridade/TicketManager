<?php
    require_once(dirname(__DIR__) . "/templates/profile.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
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