<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/departmentTicket.php");
    // Session
    include_once("../classes/session.php");
    //Classes
    include_once("../classes/department.php");
    include_once("../classes/ticket.php");
    // Database
    include_once("../database/connection.php");
    
    $session = Session::getSession();
    $db = getDatabaseConnection();
    $departments = Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);

    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }

    // Draw Page
    drawHeader(true);
    drawSidebar($session);
?>
<main class="main-sidebar">
    <div class="page">
        <?php 
        foreach ($departments as $department) {
            $tickets = Ticket::getTicketsFromDepartment($db, $department->name);
            drawDepartmentTickets($department->name, $tickets);
        } ?>
    </div>
    <div id='popup'></div>
</main>
<?php
    drawFooter();
?>