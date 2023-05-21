<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/sidebar.php");
    require_once(dirname(__DIR__) . "/templates/ticket.php");
    require_once(dirname(__DIR__) . "/templates/toast.php");
    require_once(dirname(__DIR__) . "/templates/hashtag.php");
    // Database
    require_once(dirname(__DIR__) . "/database/connection.php");
    // Classes
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/hashtag.php");
    // Session
    $session = Session::getSession();
    
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ./index.php?page=login'));
    }
    if (!$session->getMyRights(User::USERTYPE_ADMIN)) {
        die(header('Location: ./index.php?page=dashboard'));
    }

    function drawPage(array $getArray) {
        global $session;

        $db = getDatabaseConnection();
        $hashtags = Hashtag::getAllHashtags($db);

        // Draw Page
        drawHeader();
        drawSidebar($session, 'hashtags');
?>
<main class="main-sidebar">
    <div class="page center-toast">
        <h1 class="title">Hashtags</h1>
        <div id="hashtag-table">
            <?php drawHashtagTable($hashtags); ?>
        </div>
        <?php if ($session->getMyRights(User::USERTYPE_ADMIN)) { ?>
            <div class="big-button"><button id="hashtag-add-button">Add Hashtag</button></div>
            <div class="big-button"><button id="hashtag-remove-button" class="red">Remove Hashtag</button></div>
        <?php }
            drawToasts($session);
        ?>
    </div>
    <div id='popup'></div>
</main>
<?php
        drawFooter();
    }
?>