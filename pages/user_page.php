<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/sidebar.php");
    require_once(dirname(__DIR__) . "/templates/ticket.php");
    require_once(dirname(__DIR__) . "/templates/department.php");
    require_once(dirname(__DIR__) . "/templates/toast.php");
    // Database
    require_once(dirname(__DIR__) . "/database/connection.php");
    // Classes
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    // Session
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ./index.php?page=login'));
    }
    function drawPage(array $getArray) {
        global $session;

        if (!isset($getArray['username'])) {
            die(header('Location: index.php?page=dashboard'));
        }

        $db = getDatabaseConnection();
        $user = User::getUser($db, $getArray['username']);

        // Draw Page
        drawHeader();
        drawSidebar($session);
?>
<main class="main-sidebar">
    <div id="user-page" class="page">
        <h1 id="user-page-title" class="title"><?php drawProfile($user->username, true) ?></h1>
        <div class="account-item">
            <span class="account-label">Name</span>
            <div class="account-box"><?=htmlentities($user->name)?></div>
        </div>
        <div class="account-item">
            <span class="account-label">E-mail</span>
            <div class="account-box"><?=htmlentities($user->email)?></div>
        </div>
        <div class="account-item">
            <span class="account-label">User Type</span>
            <div class="account-box"><?=htmlentities($user->userType)?></div>
            <?php if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
                <a class="usertype-change option" data-username="<?=htmlentities($user->username)?>" data-user-type="<?=htmlentities($user->userType)?>"> 
                    Change...
                </a>
            <?php }?>
        </div>
        <?php if ($user->userType !== User::USERTYPE_CLIENT) {
            $user = Agent::getAgent($db, $getArray['username']);    
        ?>
        <div class="account-item">
            <span class="account-label">Departments</span>
            <div class="account-box"><?=$user->departmentString?></div>
            <?php if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
                <a class="agent-department-change option" data-username="<?=htmlentities($user->username)?>">
                    Change...
                </a>
            <?php }?>
        </div>
        <?php }
            drawToasts($session);
        ?>
    </div>
    <div id="popup"></div>
</main>
<?php
        drawFooter();
    }
?>