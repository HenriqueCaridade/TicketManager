<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/filters.php");
    require_once(dirname(__DIR__) . "/templates/ticket.php");
    
    $session = Session::getSession();
    $query = $_POST['query'] ?? "";
    $session->saveInput(Session::S_DEPARTMENT, $query);
    $db = getDatabaseConnection();
    $departments = ($session->getMyRights(User::USERTYPE_ADMIN)) ?
        Department::getAllDepartments($db) :
        Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);
    $preferences = Filters::getFilters($db, $_SESSION[Session::USERNAME]);

    foreach ($departments as $department) {
        $tickets = Ticket::getFilteredTickets($db, $department->name, $preferences, $query);
        drawTicketsDepartment($tickets, $department->name);
    }
?>