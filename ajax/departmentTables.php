<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/preferences.php");
    require_once(dirname(__DIR__) . "/templates/ticket.php");
    
    $session = Session::getSession();

    if (!isset($_POST['query'])) {
        echo '<p> An Error Occured! </p>';
        die();
    }
    $session->saveInput(Session::S_DEPARTMENT, $_POST['query']);
    $db = getDatabaseConnection();
    $departments = ($session->getRights(User::USERTYPE_ADMIN)) ?
        Department::getAllDepartments($db) :
        Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);
    $preferences = Preferences::getPreferences($db, $_SESSION[Session::USERNAME]);

    foreach ($departments as $department) {
        
        $tickets = Ticket::getFilteredTickets($db, $department->name, $preferences, $_POST['query']);
        ?> <h1> <?=htmlentities($department->name); ?></h1> <?php
        drawTicketsDepartment($tickets);
    }
?>