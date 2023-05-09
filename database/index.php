<?php
    function getDatabaseConnection() : PDO{
        return new PDO('sqlite:tables.db');
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