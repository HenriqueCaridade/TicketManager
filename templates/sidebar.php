<?php
    function drawSidebar(Session $session, string $currentPage) {
?>
<div class="sidebar">
    <a href="../pages/dashboard.php" <?php if ($currentPage == 'dashboard') echo 'class="selected"';?>>
        <span class="icon"><i class="fa-solid fa-ticket"></i></span>
        <span class="text">My Tickets</span>
    </a>
    <?php if($session->getRights(User::USERTYPE_AGENT) ) { ?>
        <a href="../pages/department_page.php" <?php if ($currentPage == 'departments') echo 'class="selected"';?>>
            <span class="icon"><i class="fa-solid fa-box-archive"></i></span>
            <span class="text">Departments</span>
        </a>
    <?php } ?>
    <?php if($session->getRights(User::USERTYPE_ADMIN) ) { ?>
        <a href="../pages/users_page.php" <?php if ($currentPage == 'users') echo 'class="selected"';?>>
            <span class="icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
            <span class="text">Users</span>
        </a>
    <?php } ?>
    <a href="../pages/settings.php" <?php if ($currentPage == 'settings') echo 'class="selected"';?>>
        <span class="icon"><i class="fa-solid fa-gear"></i></span>
        <span class="text">Settings</span>
    </a>
    <a href="../pages/help.php" <?php if ($currentPage == 'help') echo 'class="selected"';?>>
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