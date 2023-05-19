<?php
    class Preferences{
        //departments filter
        const DEPARTMENT_PRIORITY1 = 'department normal';
        const DEPARTMENT_PRIORITY2 = 'department high';
        const DEPARTMENT_PRIORITY3 = 'department urgent';

        public bool $normal;
        public bool $high;
        public bool $urgent;

        public bool $unassigned;
        public bool $inProgress;
        public bool $done;

        private function __construct(bool $normal, bool $high, bool $urgent, bool $unassigned, bool $inProgress, bool $done) {     
            $this->normal = $normal;
            $this->high = $high;
            $this->urgent = $urgent;
            $this->unassigned = $unassigned;
            $this->inProgress = $inProgress;
            $this->done = $done;
        }
        public static function updatePreferences(PDO $db, string $username, bool $normal, bool $high, bool $urgent, bool $unassigned, bool $inProgress, bool $done){
            $stmt = $db->prepare('UPDATE Preferences SET filterNormal = ?, filterHigh = ?, filterUrgent= ?, filterUnassigned = ?, filterInProgress = ?, filterDone = ?  WHERE username = ?');
            $stmt->execute(array($normal, $high, $urgent, $unassigned, $inProgress, $done, $username));
        }

        public static function getPreferences(PDO $db, string $username) : Preferences {
            $stmt = $db->prepare('SELECT * FROM Preferences WHERE username = ?');
            $stmt->execute(array($username));
            $prefArray = $stmt->fetch();
            return new Preferences($prefArray['filterNormal'], $prefArray['filterHigh'], $prefArray['filterUrgent'], $prefArray['filterUnassigned'],  $prefArray['filterInProgress'], $prefArray['filterDone']);
        }

    }
?>