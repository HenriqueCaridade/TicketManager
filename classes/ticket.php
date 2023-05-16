<?php
    declare(strict_types=1);
    include_once("../classes/ticketStatus.php");
    include_once("../classes/ticketComment.php");

    class Ticket {
        const P_NORMAL = 'Normal';
        const P_HIGH = 'High';
        const P_URGENT = 'Urgent';

        public int $id;
        public string $publisher;
        public string $department;
        public DateTime $publishDate;
        public string $priority;
        public string $subject;
        public string $text;
        public TicketStatus $status;
        public array $statuses;
        public array $comments;
        
        private function __construct(PDO $db, int $id, string $publisher, string $department, DateTime $publishDate, string $priority, string $subject, string $text) {
            $this->id = $id;
            $this->publisher = $publisher;
            $this->department = $department;
            $this->publishDate = $publishDate;
            $this->priority = $priority;
            $this->subject = $subject;
            $this->text = $text;
            $this->statuses = TicketStatus::getTicketStatuses($db, $id);
            $this->status = $this->statuses[0];
            $this->comments = TicketComment::getTicketComments($db, $id);
        }
        private static function fromArray(PDO $db, array $ticket) : Ticket {
            return new Ticket($db, (int) $ticket['id'], $ticket['publisher'], $ticket['department'], new DateTime($ticket['publishDate']), $ticket['priority'], $ticket['subject'], $ticket['text']);
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
        public static function createTicket(PDO $db, string $publisher, string $department, DateTime $publishDate, string $priority = Ticket::P_NORMAL, string $subject, string $text) : void {
            $stmt = $db->prepare('SELECT MAX(id) as max FROM Ticket');
            $stmt->execute();
            $ticketId =  $stmt->fetch()['max'] + 1;
            $stmt = $db->prepare('INSERT INTO Ticket (id, publisher, department, publishdate, priority, subject, text)  VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $publisher, $department, $publishDate->format('Y-m-d H:i:s'), $priority, $subject,  $text));
            TicketStatus::createTicketStatus($db, $ticketId, null, $publishDate, TicketStatus::UNASSIGNED);
        }
        public static function getTicketsFromDepartment (PDO $db, string $department) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE department=?');
            $stmt->execute(array($department));
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