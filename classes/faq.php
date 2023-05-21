<?php
    class FAQ {
        public int $id;
        public string $question;
        public string $answer;

        private function __construct(int $id, string $question, string $answer) {
            $this->id = $id;
            $this->question = $question;
            $this->answer = $answer;
        }
        private static function fromArray(array $comment) : FAQ {
            return new FAQ((int) $comment['id'], $comment['question'], $comment['answer']);
        }
        public static function getFAQ(PDO $db, int $id) : ?FAQ {
            $stmt = $db->prepare('SELECT * FROM FAQ WHERE id=?');
            $stmt->execute(array($id));
            $faq = $stmt->fetch();
            if ($faq === false) return null;
            return FAQ::fromArray($faq);
        }

        public static function createFAQ(PDO $db, string $question, string $answer) : void {
            $stmt = $db->prepare('INSERT INTO FAQ (question, answer) VALUES (?, ?)');
            $stmt->execute(array($question, $answer));
        }
        public static function removeFAQ(PDO $db, int $id ) : void {
            $stmt = $db->prepare('DELETE FROM FAQ WHERE id = ?');
            $stmt->execute(array($id));
        }

        public static function getAll(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM FAQ');
            $stmt->execute();
            $faqs = $stmt->fetchAll();
            $faqArray = array();
            foreach ($faqs as $faq) {
                $faqArray[] = FAQ::fromArray($faq);
            }
            return $faqArray;
        }
    }
?>