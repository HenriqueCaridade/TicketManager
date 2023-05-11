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

        public function __construct(int $id, int $ticketId, ?string $agentUsername, DateTime $date, string $status) {
            $this->id = $id;
            $this->ticketId = $ticketId;
            $this->agentUsername = $agentUsername;
            $this->date = $date;
            $this->status = $status;
        }
    }
?>