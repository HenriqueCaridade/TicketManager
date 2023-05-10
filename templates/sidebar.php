<?php
    function drawSidebar() {
?>
<div class="sidebar">
    <a href="../pages/dashboard.php">
        <span class="icon"><i class="fa-solid fa-ticket"></i></span>
        <span class="text">Dashboard</span>
    </a>
    <a href="../pages/settings.php">
        <span class="icon"><i class="fa-solid fa-gear"></i></span>
        <span class="text">Settings</span>
    </a>
    <a href="../pages/help.php">
        <span class="icon"><i class="fa-solid fa-question-circle"></i></span>
        <span class="text">Help</span>
    </a>
    <a href="../actions/logout.php">
        <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
        <span class="text sign-out">Sign Out</span>
    </a>
</div>
<?php
    }
?>