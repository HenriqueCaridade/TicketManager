<?php
    include_once("../classes/session.php");

    function drawToast(string $type, string $message, ?string $id=null) : void {
?>
<div class="toast <?=htmlentities($type)?>" <?php if ($id !== null) { ?> id="<?=htmlentities($id)?>" <?php } ?>>
    <i class="fa-solid fa-circle-exclamation"></i>
    <span class="message"><?=htmlentities($message)?></span>
</div>
<?php
    }

    function drawToasts(Session $session) { ?>
    <div id="toasts">
    <?php
        drawToast(Session::WARNING, 'Caps-Lock is active.', 'caps-warning');
        foreach ($session->fetchErrorToasts()   as $message) drawToast(Session::ERROR  , $message);
        foreach ($session->fetchWarningToasts() as $message) drawToast(Session::WARNING, $message); 
        foreach ($session->fetchSuccessToasts() as $message) drawToast(Session::SUCCESS, $message);
    ?>
    </div>
    <?php
    }
?>