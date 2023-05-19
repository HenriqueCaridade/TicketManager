<?php
    include_once("../database/connection.php");
    include_once("../classes/department.php");
    include_once("../classes/ticket.php");
    include_once("../classes/session.php");
    include_once("../classes/preferences.php");
    include_once("../templates/ticket.php");
    
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
        
        $tickets = Ticket::getFilteredTickets($db, $department->name, $preferences->normal, $preferences->high, $preferences->urgent, $_POST['query']);
        ?> <h1> <?=htmlentities($department->name); ?></h1> <?php
        drawTicketsDepartment($tickets);
    }
?>