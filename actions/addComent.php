<?php
    require_once(dirname(__DIR__) . "/database/connection.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    require_once(dirname(__DIR__) . "/classes/ticket.php");
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    $session = Session::getSession();
    if (!isset($_POST['csrf']) || $session->getCSRF() !== $_POST['csrf']) {
        $session->addToast(Session::ERROR, 'Request isn\'t legitimate.');
        die(header('Location: ../index.php?page=dashboard'));
    }
    $db = getDatabaseConnection();
    $commentLines = array();
    foreach (explode('\n', $_POST['text']) as $line) {
        $words = explode(' ', $line);
        for ($i = 0; $i < sizeof($words); $i++) {
            if (preg_match('/^FAQ#[0-9]+[.,;!?()]?$/', $words[$i]) === 1) {
                $id = substr($words[$i], 4);
                $punct = $id[strlen($id) - 1];
                if (preg_match('/[.,;!?()]/', $punct) === 1) $id = substr($id, 0, strlen($id) - 1);
                else $punct = '';
                $words[$i] = '<a href="./index.php?page=help#'. $id . '">FAQ#' . $id . '</a>' . $punct;
            } else {
                $words[$i] = htmlentities($words[$i]);
            }
        }
        $commentLines[] = join(' ', $words) ;
    }
    $comment = join('\n', $commentLines);
    TicketComment::createTicketComment($db, $_POST['ticketId'], $_POST['author'], new DateTime(), $comment);
    die(header('Location: ../index.php?page=ticket&id=' . $_POST['ticketId']));
?>