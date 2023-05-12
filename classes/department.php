<?php
    declare(strict_types=1);
    class Department{
        public string $name;

        public static function getAllDepartments( PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM Department');
            $stmt->execute();
            $deparmentArray = array();
            foreach($stmt->fetchAll() as $department){
                $deparmentArray[] = $department["name"];
            }
            return $deparmentArray ;
        }  
    }
?>