<?php
    declare(strict_types=1);
    
    class TicketStatus {
        const UNASSIGNED = 'Unassigned';
        const IN_PROGRESS = 'In progress';
        const DONE = 'Done';
        public int $id;
        public int $ticketId;
        public ?string $agentUsername; 
        public DateTime $date;
        public string $status;

        private function __construct(int $id, int $ticketId, ?string $agentUsername, DateTime $date, string $status) {
            $this->id = $id;
            $this->ticketId = $ticketId;
            $this->agentUsername = $agentUsername;
            $this->date = $date;
            $this->status = $status;
        }
        private static function fromArray(array $status) : TicketStatus {
            return new TicketStatus((int) $status['id'], (int) $status['ticketId'], $status['agentUsername'], new DateTime($status['date']), $status['status']);
        }
        public static function getTicketStatus(PDO $db, int $id) : ?TicketStatus {
            $stmt = $db->prepare('SELECT * FROM TicketStatus WHERE id=?');
            $stmt->execute(array($id));
            $status = $stmt->fetch();
            if ($status === false) return null;
            return TicketStatus::fromArray($status);
        }
        public static function createTicketStatus(PDO $db, int $ticketId, ?string $agentUsername, DateTime $date, string $text) : void {
            $stmt = $db->prepare('INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $agentUsername, $date->format('Y-m-d H:i:s'), $text));
        }

        public static function getTicketStatuses(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM TicketStatus WHERE ticketId=? ORDER BY date');
            $stmt->execute(array($id));
            $statuses = $stmt->fetchAll();
            $statusArray = array();
            foreach ($statuses as $status) {
                $statusArray[] = TicketStatus::fromArray($status);
            }
            return $statusArray;
        }
    }
?>