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
            $departmentArray = array();
            foreach($stmt->fetchAll() as $department){
                $departmentArray[] = Department::fromArray($department);
            }
            return $departmentArray;
        }

        public static function getDepartmentsFromAgent(PDO $db, string $agentUsername) : array {
            $stmt = $db->prepare('SELECT * FROM AgentInDepartment WHERE agentUsername = ?');
            $stmt->execute(array($agentUsername));
            $departmentArray = array();
            foreach($stmt->fetchAll() as $connection){
                $stmt2 = $db->prepare('SELECT * FROM Department WHERE name=?');
                $stmt2->execute(array($connection['department']));
                $department = $stmt2->fetch();
                $departmentArray[] = Department::fromArray($department);
            }
            return $departmentArray;
        }
        
        public static function removeDepartment(PDO $db, string $department) : void {
            $stmt = $db->prepare('DELETE FROM Department WHERE name=?');
            $stmt->execute(array($department));
        }

        public static function addDepartment(PDO $db, string $name, string $abbrev) : void {
            $stmt = $db->prepare('INSERT INTO Department (name, abbrev) VALUES (?, ?)');
            $stmt->execute(array($name, $abbrev));
        }
    }
?>