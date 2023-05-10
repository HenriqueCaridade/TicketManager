<?php

class User{
    public string $username;
    public string $name;
    public string $email;
    public string $hashedPassword;
    public string $userType;

    public function __construct(string $username, string $name, string $email, string $hashedPassword, string $userType) { 
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->userType = $userType;
    }
    public function dbUpdate($db) : void {
        $stmt = $db->prepare('UPDATE User SET name = ?, password = ?, email = ?, userType = ? WHERE username = ?');
        $stmt->execute(array($this->name, $this->hashedPassword, $this->email,$this->userType, $this->username));
    }
    static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
        $stmt = $db->prepare('SELECT * FROM User WHERE username=? AND password=?');
        $stmt->execute(array($username, User::passwordHash($password)));
        $user = $stmt->fetch();
        if ($user === false) return null;
        return new User($user['username'], $user['name'], $user['email'], $user['password'], $user['userType']);
    }

    static function userNameExists(PDO $db, string $username) : bool {
        $stmt = $db->prepare('SELECT * FROM User WHERE username=?');
        $stmt->execute(array($username));
        return $stmt->fetch() === false;
    }

    static function passwordHash(string $password) : string {
        return sha1($password);
    }
}
?>