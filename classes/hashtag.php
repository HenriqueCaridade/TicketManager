<?php
    declare(strict_types=1);

    class Hashtag {

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

        public static function removeHashtag(PDO $db, string $id) : void {
            $stmt = $db->prepare('DELETE FROM Hashtag WHERE name = ?');
            $stmt->execute(array($id));
        }
    }
?>