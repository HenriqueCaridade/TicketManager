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

        //this is already in sqlite datetime format
        public string $from;
        public string $to;

        private function __construct(bool $normal, bool $high, bool $urgent, bool $unassigned, bool $inProgress, bool $done, string $from, string $to) {     
            $this->normal = $normal;
            $this->high = $high;
            $this->urgent = $urgent;
            $this->unassigned = $unassigned;
            $this->inProgress = $inProgress;
            $this->done = $done;
            $this->from = $from;
            $this->to = $to;
        }
        public static function updatePreferences(PDO $db, string $username, bool $normal, bool $high, bool $urgent, bool $unassigned, bool $inProgress, bool $done, string $from, string $to){
            $stmt = $db->prepare('UPDATE Preferences SET filterNormal = ?, filterHigh = ?, filterUrgent= ?, filterUnassigned = ?, filterInProgress = ?, filterDone = ?, filterDateFrom = ?, filterDateTo = ? WHERE username = ?');
            $stmt->execute(array($normal, $high, $urgent, $unassigned, $inProgress, $done, $from, $to, $username));
        }

        public static function getPreferences(PDO $db, string $username) : Preferences {
            $stmt = $db->prepare('SELECT * FROM Preferences WHERE username = ?');
            $stmt->execute(array($username));
            $prefArray = $stmt->fetch();
            return new Preferences($prefArray['filterNormal'], $prefArray['filterHigh'], $prefArray['filterUrgent'], $prefArray['filterUnassigned'],  $prefArray['filterInProgress'], $prefArray['filterDone'], $prefArray['filterDateFrom'], $prefArray['filterDateTo']);
        }
        //convert html datetime-local to Datetime format of sqlite3
        public static function datetimeLocalToDatetime (string $date) : string {
            return substr($date, 0, 10) . ' ' . substr($date, 11, 5) . ':00';
        }
        //does the inverse of the previous function
        public static function DatetimeToDatetimeLocal (string $date) : string {
            return substr($date, 0, 10) . 'T' . substr($date, 11, 5);
        }

    }
?>