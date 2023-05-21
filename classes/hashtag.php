<?php
    declare(strict_types=1);

    class Hashtag {
        protected const MIN_HASHTAG_LENGTH = 1;
        protected const MAX_HASHTAG_LENGTH = 16;

        public int $id;
        public string $value;

        private function __construct(int $id, string $value) {
            $this->id = $id;
            $this->value = $value;
        }

        private static function fromArray(array $hashtag) : Hashtag {
            return new Hashtag((int) $hashtag['id'], $hashtag['value']);
        }
        public static function getAllHashtags(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM Hashtag');
            $stmt->execute();
            $hashtagArray = array();
            foreach($stmt->fetchAll() as $hashtag){
                $hashtagArray[] = Hashtag::fromArray($hashtag);
            }
            return $hashtagArray;
        }
        public static function getHastagsFromTicket(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM HashtagOfTicket WHERE ticketId = ?');
            $stmt->execute(array($id));
            $hashtagArray = array();
            foreach($stmt->fetchAll() as $connection){
                $stmt2 = $db->prepare('SELECT * FROM Hashtag WHERE id = ?');
                $stmt2->execute(array($connection['hashtagId']));
                $hashtag = $stmt2->fetch();
                $hashtagArray[] = Hashtag::fromArray($hashtag);
            }
            return $hashtagArray;
        }

        public static function addHashtag(PDO $db, string $value) : void {
            $stmt = $db->prepare('INSERT INTO Hashtag (value) VALUES (?)');
            $stmt->execute(array($value));
        }

        public static function removeHashtag(PDO $db, int $id) : void {
            $stmt = $db->prepare('DELETE FROM Hashtag WHERE id = ?');
            $stmt->execute(array($id));
        }

        public static function validatorHashtag(string $value) : ?string {
            $length = strlen($value);
            if ($length < Hashtag::MIN_HASHTAG_LENGTH)
                return 'Hashtag must be at least ' . Hashtag::MIN_HASHTAG_LENGTH . ' long.';
            if ($length > Hashtag::MAX_HASHTAG_LENGTH)
                return 'Hashtag must be at most ' . Hashtag::MAX_HASHTAG_LENGTH . ' long.';
            if (preg_match('/\s/', $value) === 1)
                return 'Hashtag must not have spaces.';
            if (preg_match('/\W/', $value) === 1)
                return 'Hashtag must not have special characters.';
            if (preg_match('/[A-Z]/', $value) === 1)
                return 'Hashtag must not have upper case letters.';
            return null; 
        }
    }
?>