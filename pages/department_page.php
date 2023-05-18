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
    drawSidebar($session, 'departments');
?>
<main class="main-sidebar">
    <div class="page">
        <h1 class="title">Departments</h1>
        <input id="department-search" type="text">
        <button id="department-filters"><i class="fa-solid fa-filter"></i></button>
        <?php
        
        foreach ($departments as $department) {

            $tickets = Ticket::getTicketsFromDepartmentPriorityFilter($db, $department->name, $session->getFilter(Session::DEPARTMENT_PRIORITY1), 
                $session->getFilter(Session::DEPARTMENT_PRIORITY2), $session->getFilter(Session::DEPARTMENT_PRIORITY3));
            drawDepartmentTickets($department->name, $tickets);
        }
        if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
            <div class="big-button"><button id="department-add-button">Add Department</button></div>
            <div class="big-button"><button id="department-remove-button" class="red">Remove Department</button></div>
        <?php } ?>
    </div>
    <div id='popup'></div>
</main>
<?php
    drawFooter();
?>