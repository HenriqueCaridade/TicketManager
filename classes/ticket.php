<?php
    declare(strict_types=1);
    require_once(dirname(__DIR__) . "/classes/ticketStatus.php");
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    require_once(dirname(__DIR__) . "/classes/preferences.php");
    class Ticket {

        public int $id;
        public string $publisher;
        public string $department;
        public DateTime $publishDate;
        public string $subject;
        public string $text;
        public TicketStatus $status;
        public array $statuses;
        public array $comments;
        
        private function __construct(PDO $db, int $id, string $publisher, string $department, DateTime $publishDate, string $subject, string $text) {
            $this->id = $id;
            $this->publisher = $publisher;
            $this->department = $department;
            $this->publishDate = $publishDate;
            $this->subject = $subject;
            $this->text = $text;
            $this->status = TicketStatus::getLatestTicketStatus($db, $id);
            $this->statuses = TicketStatus::getTicketStatuses($db, $id);
            $this->comments = TicketComment::getTicketComments($db, $id);
        }
        private static function fromArray(PDO $db, array $ticket) : Ticket {
            return new Ticket($db, (int) $ticket['id'], $ticket['publisher'], $ticket['department'], new DateTime($ticket['publishDate']), $ticket['subject'], $ticket['text']);
        }
        public static function getTicket(PDO $db, int $id) : ?Ticket {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE id=?');
            $stmt->execute(array($id));
            $ticket = $stmt->fetch();
            if ($ticket === false) return null;
            return Ticket::fromArray($db, $ticket);
        }

        public static function getTicketsFromUsername(PDO $db, string $username) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE publisher=?');
            $stmt->execute(array($username));
            $tickets = $stmt->fetchAll();
            $ticketArray = array();
            foreach ($tickets as $ticket) {
                $ticketArray[] = Ticket::fromArray($db, $ticket);
            }
            return $ticketArray;
        }
        public static function createTicket(PDO $db, string $publisher, string $department, DateTime $publishDate, string $subject, string $text) : void {
            $stmt = $db->prepare('SELECT MAX(id) as max FROM Ticket');
            $stmt->execute();
            $ticketId =  $stmt->fetch()['max'] + 1;
            $stmt = $db->prepare('INSERT INTO Ticket (id, publisher, department, publishdate, subject, text)  VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $publisher, $department, $publishDate->format('Y-m-d H:i:s'), $subject,  $text));
            TicketStatus::createTicketStatus($db, $ticketId, null, $publishDate, TicketStatus::NORMAL, TicketStatus::UNASSIGNED);
        }
        public static function getAllTicketsFromDepartment (PDO $db, string $department) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE department=?');
            $stmt->execute(array($department));
            $tickets = $stmt->fetchAll();
            $ticketArray = array();
            foreach ($tickets as $ticket) {
                $ticketArray[] = Ticket::fromArray($db, $ticket);
            }
            return $ticketArray;
        }
        public static function getFilteredTickets(PDO $db, string $department, Preferences $filters, string $query = '') : array {
            $priorityArray = array_filter(array($filters->normal ? 'Normal' : null , $filters->high ? 'High': null, $filters->urgent ? 'Urgent' : null), fn($val) => $val !== null);
            $statusArray = array_filter(array($filters->unassigned ? 'Unassigned' : null, $filters->assigned ? 'Assigned' : null, $filters->done ? 'Done' : null), fn($val) => $val !== null);
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE department = ? AND (publishDate BETWEEN ? AND ?) AND (subject LIKE ? OR text LIKE ?) AND id IN (SELECT ticketId FROM LatestStatus WHERE status IN (' . join(',', array_fill(0, sizeof($statusArray), '?')) . ') AND priority IN (' . join(',', array_fill(0, sizeof($priorityArray), '?')) . '))');
            $query = '%' . str_replace(array('\\', '_', '%'), array('\\\\', '\\_', '\\%'), $query) . '%';
            $stmt->execute(array($department, $filters->from, $filters->to, $query, $query, ...$statusArray, ...$priorityArray));
            $tickets = $stmt->fetchAll();
            $ticketArray = array();
            foreach ($tickets as $ticket) {
                $ticketArray[] = Ticket::fromArray($db, $ticket);
            }
            return $ticketArray;
        }
        public static function changeDepartment (PDO $db, int $id, string $department) : void {
            $stmt = $db->prepare('UPDATE Ticket SET department = ? WHERE id = ?');
            $stmt->execute(array($department, $id));
        }
        

    }
?>