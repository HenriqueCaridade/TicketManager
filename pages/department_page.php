<?php
    // Templates
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    include_once("../templates/sidebar.php");
    include_once("../templates/ticket.php");
    // Session
    include_once("../classes/session.php");
    //Classes
    include_once("../classes/department.php");
    include_once("../classes/ticket.php");
    include_once("../classes/preferences.php");
    // Database
    include_once("../database/connection.php");
    
    $session = Session::getSession();
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ../pages/login_page.php'));
    }
    if (!$session->getRights(User::USERTYPE_AGENT)) {
        die(header('Location: ../pages/dashboard.php'));
    }

    $db = getDatabaseConnection();
    $departments = ($session->getRights(User::USERTYPE_ADMIN)) ?
        Department::getAllDepartments($db) :
        Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);
    $preferences = Preferences::getPreferences($db, $_SESSION[Session::USERNAME]);
    $query = $session->getSavedInput(Session::S_DEPARTMENT)?? '';
    // Draw Page
    drawHeader(true);
    drawSidebar($session, 'departments');
?>
<main class="main-sidebar">
    <div class="page">
        <h1 class="title">Departments</h1>
        <input id="department-search" type="search" placeholder="Search ticket..." value="<?=$query?>">
        <button id="department-filters"><i class="fa-solid fa-filter"></i></button>
        <div id="department-tables">
            <?php
            foreach ($departments as $department) {
                $tickets = Ticket::getFilteredTickets($db, $department->name, $preferences, $query);
                ?> <h1> <?=htmlentities($department->name); ?></h1> <?php
                drawTicketsDepartment($tickets);
            }?>
        </div>
        <?php if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
            <div class="big-button"><button id="department-add-button">Add Department</button></div>
            <div class="big-button"><button id="department-remove-button" class="red">Remove Department</button></div>
        <?php } ?>
    </div>
    <div id='popup'></div>
</main>
<?php
    drawFooter();
?>