<?php
    declare(strict_types=1);
    
    class TicketStatus {
        const NORMAL = 'Normal';
        const HIGH = 'High';
        const URGENT = 'Urgent';
        const UNASSIGNED = 'Unassigned';
        const ASSIGNED = 'Assigned';
        const DONE = 'Done';
        public int $id;
        public int $ticketId;
        public ?string $agentUsername; 
        public DateTime $date;
        public string $priority;
        public string $status;

        private function __construct(int $id, int $ticketId, ?string $agentUsername, DateTime $date, string $priority, string $status) {
            $this->id = $id;
            $this->ticketId = $ticketId;
            $this->agentUsername = $agentUsername;
            $this->date = $date;
            $this->priority = $priority;
            $this->status = $status;
        }
        private static function fromArray(array $status) : TicketStatus {
            return new TicketStatus((int) $status['id'], (int) $status['ticketId'], $status['agentUsername'], new DateTime($status['date']), $status['priority'], $status['status']);
        }
        public static function getTicketStatus(PDO $db, int $id) : ?TicketStatus {
            $stmt = $db->prepare('SELECT * FROM TicketStatus WHERE id=?');
            $stmt->execute(array($id));
            $status = $stmt->fetch();
            if ($status === false) return null;
            return TicketStatus::fromArray($status);
        }
        public static function createTicketStatus(PDO $db, int $ticketId, ?string $agentUsername, DateTime $date, string $priority, string $status) : void {
            $stmt = $db->prepare('INSERT INTO TicketStatus (ticketId, agentUsername, date, priority, status) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $agentUsername, $date->format('Y-m-d H:i:s'), $priority, $status));
        }

        public static function getTicketStatuses(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM TicketStatus WHERE ticketId=? ORDER BY date DESC');
            $stmt->execute(array($id));
            $statuses = $stmt->fetchAll();
            $statusArray = array();
            foreach ($statuses as $status) {
                $statusArray[] = TicketStatus::fromArray($status);
            }
            return $statusArray;
        }

        public static function getLatestTicketStatus(PDO $db, int $id) : ?TicketStatus {
            $stmt = $db->prepare('SELECT * FROM LatestStatus WHERE ticketId=?');
            $stmt->execute(array($id));
            $status = $stmt->fetch();
            if ($status === false) return null;
            return TicketStatus::fromArray($status);
        }
    }
?>