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

        $db = getDatabaseConnection();
        $tickets = Ticket::getTicketsFromUsername($db, $_SESSION[Session::USERNAME]);
        $departments = Department::getAllDepartments($db);

        // Draw Page
        drawHeader();
        drawSidebar($session, 'dashboard');
?>
<main class="main-sidebar">
    <div id="dashboard" class="page center-toast">
        <h1 id="dashboard-title" class="title">My Tickets</h1>
        <?php drawTickets($tickets); ?>
        <div class="big-button">
            <button id="ticket-open-button" onclick="openPopup()">Add Ticket</button>
        </div>
        <?php drawToasts($session); ?>
    </div>
    <div id="popup">
        <div id="popup-darken" onclick="closePopup()"></div>
        <div id="popup-form">
            <form action="../actions/addTicket.php" method="post">
                <div class="popup-item">
                    <span>Subject</span>
                    <input type="text" minlength="5" name="subject" required>
                </div>
                <div class="popup-item">
                    <span>Text</span>
                    <textarea name="text" minlength="30" maxlength="500" required></textarea>
                </div>
                <div class="popup-item">
                    <span>Department</span>
                    <?php drawDepartments($departments); ?>
                </div>
                <div class="popup-item">
                    <button type="submit" class="submit-button">Submit</button>
                </div>
            </form>
            <button type="button" class="red" onclick="closePopup()">Close</button>
        </div>
    </div>
</main>
<?php  
        drawFooter();
    }
?>