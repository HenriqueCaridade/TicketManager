<?php
    include_once("../classes/ticket.php");
    include_once("../templates/profile.php");
    function _drawDepartment(string $department) {
?>
    <option value = '<?=htmlentities($department)?>'> <?=htmlentities($department)?></option>
<?php
    }

    function drawDepartments(array $departments) {
?>
<select name="department" id="department-dropdown">
    <?php
    foreach ($departments as $department) {
        _drawDepartment($department);
    }
    ?>
    </tbody>
</select>
<?php
    }
?>