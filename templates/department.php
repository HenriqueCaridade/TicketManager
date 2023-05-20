<?php
    require_once(dirname(__DIR__) . "/templates/profile.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    function _drawDepartment(Department $department, ?string $selected=null) {
?>
    <option value = '<?=htmlentities($department->name)?>' <?php if ($selected !== null && $selected === $department->name) { ?> selected <?php } ?>> <?=htmlentities($department->name)?></option>
<?php
    }

    function drawDepartments(array $departments, ?string $selected=null) {
?>
<select name="department">
    <?php
    foreach ($departments as $department) {
        _drawDepartment($department, $selected);
    }
    ?>
</select>
<?php
    }
?>