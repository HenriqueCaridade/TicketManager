<?php
    declare(strict_types=1);
    include_once("../classes/ticketStatus.php");

    class Ticket {
        const P_NORMAL = 'Normal';
        const P_HIGH = 'High';
        const P_URGENT = 'Urgent';

        public int $id;
        public string $publisher;
        public string $department;
        public DateTime $publishDate;
        public string $priority;
        public string $text;
        public TicketStatus $status;
        public array $statuses;

        private function __construct(PDO $db, int $id, string $publisher, string $department, DateTime $publishDate, string $priority, string $text) {
            $this->id = $id;
            $this->publisher = $publisher;
            $this->department = $department;
            $this->publishDate = $publishDate;
            $this->priority = $priority;
            $this->text = $text;
            $this->statuses = Ticket::getTicketStatuses($db, $id);
            $this->status = $this->statuses[0];
        }
        private static function arrayToTicket(PDO $db, array $ticket) : Ticket {
            return new Ticket($db, (int) $ticket['id'], $ticket['publisher'], $ticket['department'], new DateTime($ticket['publishDate']), $ticket['priority'], $ticket['text']);
        }
        static function getTicket(PDO $db, int $id) : ?Ticket {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE id=?');
            $stmt->execute(array($id));
            $ticket = $stmt->fetch();
            if ($ticket === false) return null;
            return Ticket::arrayToTicket($db, $ticket);
        }
        static function getTicketStatuses(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM TicketStatus WHERE ticketId=?');
            $stmt->execute(array($id));
            $statuses = $stmt->fetchAll();
            $statusArray = array();
            foreach ($statuses as $status) {
                $statusArray[] = new TicketStatus((int) $status['id'], (int) $status['ticketId'], $status['agentUsername'], new DateTime($status['date']), $status['status']);
            }
            // Order from newer to older
            usort($statusArray, fn(TicketStatus $a, TicketStatus $b) => ($a->date > $b->date) ? 1 : (($a->date < $b->date) ? -1 : 0));
            return $statusArray;
        }

        static function getTicketsFromUsername(PDO $db, string $username) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE publisher=?');
            $stmt->execute(array($username));
            $tickets = $stmt->fetchAll();
            $ticketArray = array();
            foreach ($tickets as $ticket) {
                $ticketArray[] = Ticket::arrayToTicket($db, $ticket);
            }
            return $ticketArray;
        }
        public static function createTicket(PDO $db, string $publisher, string $department, DateTime $publishDate, string $priority = Ticket::P_NORMAL, string $text) : void {
            $stmt = $db->prepare('INSERT INTO Ticket (publisher, department, publishdate, priority, text)  VALUES (?, ?, ?, ?, ?)');
            $stmt->execute(array($publisher, $department, $publishDate, $priority, $text));
        }
    }
?>