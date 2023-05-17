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
    if (!$session->isLoggedIn() || !$session->getRights(User::USERTYPE_AGENT)) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    $db = getDatabaseConnection();
    $departments = ($session->getRights(User::USERTYPE_ADMIN)) ?
        Department::getAllDepartments($db) :
        Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);

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