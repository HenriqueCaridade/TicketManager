<?php
    class Preferences{
        //departments filter
        const DEPARTMENT_PRIORITY1 = 'department normal';
        const DEPARTMENT_PRIORITY2 = 'department high';
        const DEPARTMENT_PRIORITY3 = 'department urgent';

        public bool $normal;
        public bool $high;
        public bool $urgent;
        
        private function __construct(bool $normal, bool $high, bool $urgent) {     
            $this->normal = $normal;
            $this->high = $high;
            $this->urgent = $urgent;
        }
        public static function updatePreferences(PDO $db, string $username, bool $normal, bool $high, bool $urgent){
            $stmt = $db->prepare('UPDATE Preferences SET filterNormal = ?, filterHigh = ?, filterUrgent= ? WHERE username = ?');
            $stmt->execute(array($normal, $high, $urgent, $username));
        }

        public static function getPreferences(PDO $db, string $username) : Preferences {
            $stmt = $db->prepare('SELECT * FROM Preferences WHERE username = ?');
            $stmt->execute(array($username));
            $prefArray = $stmt->fetch();
            return new Preferences($prefArray['filterNormal'], $prefArray['filterHigh'], $prefArray['filterUrgent']);
        }

    }
?>