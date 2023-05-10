<?php
    include_once("../classes/session.php");

    function drawToast(string $type, string $message) : void {
?>
<div class="toast <?=htmlentities($type)?>">
    <i class="fa-solid fa-circle-exclamation"></i>
    <span class="message"><?=htmlentities($message)?></span>
</div>
<?php
    }

    function drawToasts(Session $session) { ?>
    <div id="toasts">
    <?php
        foreach ($session->fetchErrorToasts()   as $message) drawToast(Session::ERROR  , $message);
        foreach ($session->fetchSuccessToasts() as $message) drawToast(Session::SUCCESS, $message);
    ?>
    </div>
    <?php
    }
?>