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
    $tickets = Ticket::getTicketsFromUsername($db, $_SESSION[Session::USERNAME]);
    $departments = Department::getAllDepartments($db);

    // Draw Page
    drawHeader(true);
    drawSidebar($session, 'dashboard');
?>
<main class="main-sidebar">
    <div id="dashboard" class="page">
        <h1 id="dashboard-title" class="title">My Tickets</h1>
        <?php drawTickets($tickets); ?>
        <div class="big-button">
            <button id="ticket-open-button" onclick="openPopup()">Add Ticket</button>
        </div>
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
?>