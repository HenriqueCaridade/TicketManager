<?php
    date_default_timezone_set("Europe/Lisbon");
    include_once('./classes/session.php');
    $session = Session::getSession();
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'login': include_once("./pages/login_page.php"); break;
            case 'register': include_once("./pages/register_page.php"); break;
            case 'dashboard': include_once("./pages/dashboard.php"); break;
            case 'departments': include_once("./pages/department_page.php"); break;
            case 'users': include_once("./pages/users_page.php"); break;
            case 'settings': include_once("./pages/settings.php"); break;
            case 'account': include_once("./pages/user_page.php"); break;
            case 'ticket': include_once("./pages/ticket_page.php"); break;
            case 'ticket-history': include_once("./pages/history_page.php"); break;
            case 'help': include_once("./pages/help.php"); break;
            default: die(header('Location: ./index.php?page=login'));
        }
    } else {
        die(header('Location: ./index.php?page=login'));
    }
    drawPage($_GET);
?>
