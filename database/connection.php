<?php
    function getDatabaseConnection() : PDO{
        return new PDO('sqlite:tables.db');
    }
?>