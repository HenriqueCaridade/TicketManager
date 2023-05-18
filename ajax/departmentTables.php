<?php
    include_once("../database/connection.php");
    include_once("../classes/department.php");
    include_once("../classes/ticket.php");
    include_once("../classes/session.php");
    include_once("../templates/ticket.php");
    
    $session = Session::getSession();

    if (!isset($_POST['query'])) {
        echo '<p> An Error Occured! </p>';
        die();
    }
    $db = getDatabaseConnection();
    $departments = ($session->getRights(User::USERTYPE_ADMIN)) ?
        Department::getAllDepartments($db) :
        Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);

    foreach ($departments as $department) {
        $tickets = Ticket::getFilteredTickets($db, $department->name, $session->getFilter(Session::DEPARTMENT_PRIORITY1), 
            $session->getFilter(Session::DEPARTMENT_PRIORITY2), $session->getFilter(Session::DEPARTMENT_PRIORITY3), $_POST['query']);
        ?> <h1> <?=htmlentities($department->name); ?></h1> <?php
        drawTicketsDepartment($tickets);
    }
?>