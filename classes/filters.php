<?php
    class Filters {
        //departments filter
        const DEPARTMENT_PRIORITY1 = 'department normal';
        const DEPARTMENT_PRIORITY2 = 'department high';
        const DEPARTMENT_PRIORITY3 = 'department urgent';

        public bool $normal;
        public bool $high;
        public bool $urgent;

        public bool $unassigned;
        public bool $assigned;
        public bool $done;

        //this is already in sqlite datetime format
        public string $from;
        public string $to;

        private function __construct(bool $normal, bool $high, bool $urgent, bool $unassigned, bool $assigned, bool $done, string $from, string $to) {     
            $this->normal = $normal;
            $this->high = $high;
            $this->urgent = $urgent;
            $this->unassigned = $unassigned;
            $this->assigned = $assigned;
            $this->done = $done;
            $this->from = $from;
            $this->to = $to;
        }
        public static function updateFilters(PDO $db, string $username, bool $normal, bool $high, bool $urgent, bool $unassigned, bool $assigned, bool $done, string $from, string $to){
            $stmt = $db->prepare('UPDATE Filters SET filterNormal = ?, filterHigh = ?, filterUrgent= ?, filterUnassigned = ?, filterAssigned = ?, filterDone = ?, filterDateFrom = ?, filterDateTo = ? WHERE username = ?');
            $stmt->execute(array($normal, $high, $urgent, $unassigned, $assigned, $done, $from, $to, $username));
        }

        public static function getFilters(PDO $db, string $username) : ?Filters {
            $stmt = $db->prepare('SELECT * FROM Filters WHERE username = ?');
            $stmt->execute(array($username));
            $prefArray = $stmt->fetch();
            if ($prefArray === false) return null;
            return new Filters($prefArray['filterNormal'], $prefArray['filterHigh'], $prefArray['filterUrgent'], $prefArray['filterUnassigned'],  $prefArray['filterAssigned'], $prefArray['filterDone'], $prefArray['filterDateFrom'], $prefArray['filterDateTo']);
        }
        //convert html datetime-local to Datetime format of sqlite3
        public static function datetimeLocalToDatetime (string $date) : string {
            return substr($date, 0, 10) . ' ' . substr($date, 11, 5) . ':00';
        }
        //does the inverse of the previous function
        public static function DatetimeToDatetimeLocal (string $date) : string {
            return substr($date, 0, 10) . 'T' . substr($date, 11, 5);
        }

        public static function getFiltersCondition (Filters $Filters) : string {
            if ($Filters->unassigned) {
                if ($Filters->assigned) {
                    if ($Filters->done){
                        return 'TRUE';
                    } else {
                        return '(status = "Not Done")';
                    }
                } else {
                    if ($Filters->done){
                        return '((status = "Not Done" AND agentUsername IS NULL) OR (status = "Done" AND agentUsername IS NOT NULL))';
                    } else {
                        return '(status = "Not Done" AND agentUsername IS NULL)';
                    }
                }
            } else {
                if ($Filters->assigned) {
                    if ($Filters->done){
                        return '(agentUsername IS NOT NULL)';
                    } else {
                        return '(status = "Not Done" AND agentUsername IS NOT NULL)';
                    }
                } else {
                    if ($Filters->done){
                        return '(status = "Done")';
                    } else {
                        return 'FALSE';
                    }
                }
            }
        }
    }
?>