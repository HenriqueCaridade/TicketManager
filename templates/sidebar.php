<?php
    function drawSidebar(Session $session, string $currentPage='NONE') {
?>
<div class="sidebar">
    <a href="./index.php?page=dashboard" <?php if ($currentPage == 'dashboard') echo 'class="selected"';?>>
        <span class="icon"><i class="fa-solid fa-ticket"></i></span>
        <span class="text">My Tickets</span>
    </a>
    <?php if($session->getMyRights(User::USERTYPE_AGENT) ) { ?>
        <a href="./index.php?page=departments" <?php if ($currentPage == 'departments') echo 'class="selected"';?>>
            <span class="icon"><i class="fa-solid fa-box-archive"></i></span>
            <span class="text">Departments</span>
        </a>
    <?php } ?>
    <?php if($session->getMyRights(User::USERTYPE_ADMIN) ) { ?>
        <a href="./index.php?page=users" <?php if ($currentPage == 'users') echo 'class="selected"';?>>
            <span class="icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
            <span class="text">Users</span>
        </a>
        <a href="./index.php?page=hashtags" <?php if ($currentPage == 'hashtags') echo 'class="selected"';?>>
            <span class="icon"><i class="fa-solid fa-hashtag"></i></span>
            <span class="text">Hashtags</span>
        </a>
    <?php } ?>
    <a href="./index.php?page=settings" <?php if ($currentPage == 'settings') echo 'class="selected"';?>>
        <span class="icon"><i class="fa-solid fa-gear"></i></span>
        <span class="text">Settings</span>
    </a>
    <a href="./index.php?page=help" <?php if ($currentPage == 'help') echo 'class="selected"';?>>
        <span class="icon"><i class="fa-solid fa-question-circle"></i></span>
        <span class="text">Help</span>
    </a>
    <a href="./actions/logout.php">
        <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
        <span class="text sign-out">Sign Out</span>
    </a>
</div>
<?php
    }
?>