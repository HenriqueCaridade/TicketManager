<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/ticket.php");
    // Session
    include_once("../database/connection.php");
    include_once("../classes/session.php");
    include_once("../classes/ticket.php");
    $session = Session::getSession();

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    $db = getDatabaseConnection();
    $tickets = Ticket::getTicketsFromUsername($db, $_SESSION[Session::USERNAME]);

    // Draw Page
    drawHeader(true);
    drawSidebar();
?>

<main class="main-sidebar">
    
    <div id="dashboard" class="page">
        <h1 id="dashboard-title" class="title">Dashboard</h1>
        <?php drawTickets($tickets); ?>
        <div class="openBtn">
            <button class="openButton" onclick="openTicketForm()"><strong>Open Form</strong></button>
        </div>
        <div class="ticketPopup">
            <div class = "formPopup" id ="popupForm">
            <form action="../actions/addTicket.php" method="post" class="formContainer">
                <div class="add-ticket-item">
                    <span>Text</span>
                    <input type="text" name="text" required>
                 </div>
                <div class="add-ticket-item">
                    <button type="submit" class="btn">Submit</button>
                    <button type="button" class="btn cancel" onclick="closeTicketForm()">Close</button>
                </div>
            </form>
            </div>
            
        </div>
</main>
<?php  
    drawFooter();
?>