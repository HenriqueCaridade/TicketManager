<?php
    declare(strict_types=1);
    require_once(dirname(__DIR__) . "/classes/ticketChange.php");
    require_once(dirname(__DIR__) . "/classes/ticketComment.php");
    require_once(dirname(__DIR__) . "/classes/filters.php");
    class Ticket {
        const NORMAL = 'Normal';
        const HIGH = 'High';
        const URGENT = 'Urgent';
        const UNASSIGNED = 'Unassigned';
        const ASSIGNED = 'Assigned';
        const DONE = 'Done';

        public int $id;
        public string $publisher;
        public DateTime $date;
        public string $subject;
        public string $text;
        public string $department;
        public string $priority;
        public string $status;
        public ?string $agentUsername;
        public array $changes;
        public array $comments;
        
        private function __construct(PDO $db, int $id, string $publisher, DateTime $date, string $subject, string $text, string $department, string $priority, string $status, ?string $agentUsername) {
            $this->id = $id;
            $this->publisher = $publisher;
            $this->date = $date;
            $this->subject = $subject;
            $this->text = $text;
            $this->department = $department;
            $this->priority = $priority;
            if ($status === 'Done') {
                $this->status = Ticket::DONE;
            } else if ($status === 'Not Done') {
                $this->status = ($agentUsername === null) ? Ticket::UNASSIGNED : Ticket::ASSIGNED;
            }
            $this->agentUsername = $agentUsername;
            $this->changes = TicketChange::getTicketChanges($db, $id);
            $this->comments = TicketComment::getTicketComments($db, $id);
        }
        private static function fromArray(PDO $db, array $ticket) : Ticket {
            return new Ticket($db, (int) $ticket['id'], $ticket['publisher'], new DateTime($ticket['date']), $ticket['subject'], $ticket['text'], $ticket['department'], $ticket['priority'], $ticket['status'], $ticket['agentUsername']);
        }
        public function getFormattedDate() : string {
            return $this->date->format('H:i:s d-m-Y');
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
        public static function createTicket(PDO $db, string $publisher, DateTime $date, string $subject, string $text, string $department) : void {
            $stmt = $db->prepare('SELECT MAX(id) as max FROM Ticket');
            $stmt->execute();
            $ticketId =  $stmt->fetch()['max'] + 1;
            $stmt = $db->prepare('INSERT INTO Ticket (id, publisher, date, subject, text, department)  VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $publisher, $date->format('Y-m-d H:i:s'), $subject, $text, $department));
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
        public static function getFilteredTickets(PDO $db, string $department, Filters $filters, string $query = '') : array {
            $priorityArray = array_filter(array($filters->normal ? 'Normal' : null , $filters->high ? 'High' : null, $filters->urgent ? 'Urgent' : null), fn($val) => $val !== null);
            $cond = Filters::getFiltersCondition($filters);
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE department = ? AND (date BETWEEN ? AND ?) AND ' . $cond . ' AND (subject LIKE ? OR text LIKE ?) AND priority IN (' . join(',', array_fill(0, sizeof($priorityArray), '?')) . ')');
            $query = '%' . str_replace(array('\\', '_', '%'), array('\\\\', '\\_', '\\%'), $query) . '%';
            $stmt->execute(array($department, $filters->from, $filters->to, $query, $query, ...$priorityArray));
            $tickets = $stmt->fetchAll();
            $ticketArray = array();
            foreach ($tickets as $ticket) {
                $ticketArray[] = Ticket::fromArray($db, $ticket);
            }
            return $ticketArray;
        }
        public static function changeDepartment (PDO $db, int $id, string $department) : void {
            $stmt = $db->prepare('UPDATE Ticket SET department = ?, date = ? WHERE id = ?');
            $stmt->execute(array($department, (new DateTime())->format('Y-m-d H:i:s'), $id));
        }

        public static function changePriority (PDO $db, int $id, string $priority) : void {
            $stmt = $db->prepare('UPDATE Ticket SET priority = ?, date = ?  WHERE id = ?');
            $stmt->execute(array($priority, (new DateTime())->format('Y-m-d H:i:s'), $id));
        }

        public static function changeStatusAndAgent (PDO $db, int $id, string $status, ?string $agentUsername=null) : void {
            if ($status === Ticket::DONE) {
                $stmt = $db->prepare('UPDATE Ticket SET status = "Done", date = ? WHERE id = ?');
                $stmt->execute(array((new DateTime())->format('Y-m-d H:i:s'), $id));
            } else if ($status === Ticket::ASSIGNED) {
                if ($agentUsername === null){
                    $stmt = $db->prepare('UPDATE Ticket SET status = "Not Done", date = ? WHERE id = ?');
                    $stmt->execute(array((new DateTime())->format('Y-m-d H:i:s'), $id));
                } else {
                    $stmt = $db->prepare('UPDATE Ticket SET agentUsername = ?, date = ? WHERE id = ?');
                    $stmt->execute(array($agentUsername, (new DateTime())->format('Y-m-d H:i:s'), $id));
                }
            } else if ($status === Ticket::UNASSIGNED) {
                $stmt = $db->prepare('UPDATE Ticket SET agentUsername = ?, date = ? WHERE id = ?');
                $stmt->execute(array(null, (new DateTime())->format('Y-m-d H:i:s'), $id));
            }
        }
    }
?>