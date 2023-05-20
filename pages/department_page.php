<?php
    // Templates
    require_once(dirname(__DIR__) . "/templates/header.php");
    require_once(dirname(__DIR__) . "/templates/footer.php");
    require_once(dirname(__DIR__) . "/templates/sidebar.php");
    require_once(dirname(__DIR__) . "/templates/ticket.php");
    require_once(dirname(__DIR__) . "/templates/toast.php");
    // Database
    require_once(dirname(__DIR__) . "/database/connection.php");
    // Classes
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/department.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/preferences.php");
    // Session
    $session = Session::getSession();
    
    if (!$session->isLoggedIn()) {
        $session->addToast(Session::ERROR, 'You are not logged in!');
        die(header('Location: ./index.php?page=login'));
    }
    if (!$session->getRights(User::USERTYPE_AGENT)) {
        die(header('Location: ./index.php?page=dashboard'));
    }

    function drawPage(array $getArray) {
        global $session;

        $db = getDatabaseConnection();
        $departments = ($session->getRights(User::USERTYPE_ADMIN)) ?
            Department::getAllDepartments($db) :
            Department::getDepartmentsFromAgent($db, $_SESSION[Session::USERNAME]);
        $preferences = Preferences::getPreferences($db, $_SESSION[Session::USERNAME]);
        $query = $session->getSavedInput(Session::S_DEPARTMENT) ?? '';

        // Draw Page
        drawHeader();
        drawSidebar($session, 'departments');
?>
<main class="main-sidebar">
    <div class="page center-toast">
        <h1 class="title">Departments</h1>
        <input id="department-search" type="search" placeholder="Search ticket..." value="<?=$query?>">
        <button id="department-filters"><i class="fa-solid fa-filter"></i></button>
        <div id="department-tables">
            <?php
            foreach ($departments as $department) {
                $tickets = Ticket::getFilteredTickets($db, $department->name, $preferences, $query);
                //$tickets = Ticket::getAllTicketsFromDepartment($db, $department->name);
                drawTicketsDepartment($tickets, $department->name);
            }?>
        </div>
        <?php if ($session->getRights(User::USERTYPE_ADMIN)) { ?>
            <div class="big-button"><button id="department-add-button">Add Department</button></div>
            <div class="big-button"><button id="department-remove-button" class="red">Remove Department</button></div>
        <?php }
            drawToasts($session);
        ?>
    </div>
    <div id='popup'></div>
</main>
<?php
        drawFooter();
    }
?>