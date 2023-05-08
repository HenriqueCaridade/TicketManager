<?php
    function getDatabaseConnection(){
        return new PDO('sqlite:tables.db');
    }
    function getUser(string $username, PDO $db){
        $stmt = $db->prepare('SELECT * FROM User WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }
    /*
  $stmt = $db->prepare('SELECT * FROM User');
  $stmt->execute();
  $users = $stmt->fetchAll();
  foreach( $users as $property) {
    echo '<h1>' . $property['username'] . '</h1>';
    echo '<p>' . $property['name'] . '</p>';
  };*/

?>