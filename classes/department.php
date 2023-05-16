<?php
    declare(strict_types=1);
    class Department{
        public string $name;
        public string $abbrev;

        private function __construct(string $name, string $abbrev) {
            $this->name = $name;
            $this->abbrev = $abbrev;
        }

        private static function fromArray(array $department) : Department {
            return new Department($department["name"], $department["abbrev"]);
        }

        public static function getAllDepartments(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM Department');
            $stmt->execute();
            $deparmentArray = array();
            foreach($stmt->fetchAll() as $department){
                $deparmentArray[] = Department::fromArray($department);
            }
            return $deparmentArray;
        }

        public static function getDepartmentsFromAgent(PDO $db, int $agentUsername) : array {
            $stmt = $db->prepare('SELECT * FROM AgentInDepartment WHERE agentUsername=?');
            $stmt->execute(array($agentUsername));
            $deparmentArray = array();
            foreach($stmt->fetchAll() as $connection){
                $stmt2 = $db->prepare('SELECT * FROM Department WHERE name=?');
                $stmt2->execute(array($connection['department']));
                $department = $stmt2->fetch();
                $deparmentArray[] = Department::fromArray($department);
            }
            return $deparmentArray;
        }
    }
?>