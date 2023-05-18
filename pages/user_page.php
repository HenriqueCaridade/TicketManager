<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/ticket.php");
    include_once("../templates/department.php");
    // Session
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/ticket.php");
    include_once("../classes/department.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    $db = getDatabaseConnection();
    $user = User::getUser($db, $_POST['username']);
    if ($user->userType !== USER::USERTYPE_CLIENT)
        $user = Agent::getAgent($db, $_POST['username']);
    

    drawHeader(true);
    drawSidebar($session, 'NONE');
?>
<main class="main-sidebar">
    <div id="user-page" class="page">
        <h1 id="user-page-title" class="title"><?php drawProfile($user->username, true) ?></h1>
        <div class="account-item">
            Name: <?=htmlentities($user->name)?>
        </div>
        <div class="account-item">
            E-mail: <?=htmlentities($user->email)?>
        </div>
        <div class="account-item">
            User Type:
            <?php if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
                <a class="usertype-change" data-username="<?=htmlentities($user->username)?>" data-user-type="<?=htmlentities($user->userType)?>"> 
                    <?=htmlentities($user->userType)?> 
                </a>
            <?php }?>
        </div>
        <?php if ($user->userType !== User::USERTYPE_CLIENT) { ?>
        <div>
            Departments:
            <?php if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
                <a class="agent-department-change" data-username="<?=htmlentities($user->username)?>">
                    <?=$user->departmentString?>
                </a>
            <?php }?>
        </div>
        <?php }?>
    </div>
    <div id="popup"></div>
</main>
<?php
    drawFooter();
?>