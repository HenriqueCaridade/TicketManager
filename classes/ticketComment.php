<?php
    class TicketComment {
        public int $id;
        public int $ticketId;
        public string $user; 
        public DateTime $date;
        public string $text;

        private function __construct(int $id, int $ticketId, string $user, DateTime $date, string $text) {
            $this->id = $id;
            $this->ticketId = $ticketId;
            $this->user = $user;
            $this->date = $date;
            $this->text = $text;
        }
        private static function fromArray(array $comment) : TicketComment {
            return new TicketComment((int) $comment['id'], (int) $comment['ticketId'], $comment['user'], new DateTime($comment['date']), $comment['text']);
        }
        public function getFormattedDate() : string {
            return $this->date->format('Y-m-d H:i:s');
        }
        public static function getTicketComment(PDO $db, int $id) : ?TicketComment {
            $stmt = $db->prepare('SELECT * FROM TicketComment WHERE id=?');
            $stmt->execute(array($id));
            $comment = $stmt->fetch();
            if ($comment === false) return null;
            return TicketComment::fromArray($comment);
        }

        public static function createTicketComment(PDO $db, int $ticketId, string $user, DateTime $date, string $text) : void {
            $stmt = $db->prepare('INSERT INTO TicketComment (ticketId, user, date, text) VALUES (?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $user, $date->format('Y-m-d H:i:s'), $text));
        }

        public static function getTicketComments(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM TicketComment WHERE ticketId=? ORDER BY date DESC');
            $stmt->execute(array($id));;
            $comments = $stmt->fetchAll();
            $commentArray = array();
            foreach ($comments as $comment) {
                $commentArray[] = TicketComment::fromArray($comment);
            }
            return $commentArray;
        }
    }
?>