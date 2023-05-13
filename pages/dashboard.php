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
    drawSidebar();
?>

<main class="main-sidebar">
    
    <div id="dashboard" class="page">
        <h1 id="dashboard-title" class="title">Dashboard</h1>
        <?php drawTickets($tickets); ?>
        <button class="open-button" onclick="openTicketForm()"> Submit Ticket</button>
        <div id="ticket-darken"></div>
        <div class="ticket-popup">
            <div class = "form-popup" id ="popup-form">
            <form action="../actions/addTicket.php" method="post" class="ticket-form">
                <div class="add-ticket-item">
                    <span>Subject</span>
                    <input type="text" name="subject" required>
                </div>
                <div class="add-ticket-item">
                    <span>Text</span>
                    <input type="text" name="text" required>
                </div>
                <div class="add-ticket-item">
                    <span>Departments:</span>
                    <?php drawDepartments($departments); ?>
                 </div>
                <div class="add-ticket-item">
                    <button type="submit" class="btn">Submit</button>
                    <button type="button" class="btn-cancel" onclick="closeTicketForm()">Close</button>
                </div>
            </form>
            </div>
        </div>
</main>
<?php  
    drawFooter();
?>