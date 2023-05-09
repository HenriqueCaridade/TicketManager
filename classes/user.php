<?php
enum UserType{
    case Client;
    case Agent;
    case Admin;
}

class User{
    public string $username;
    public string $name;
    public string $password;
    public string $email;
    public UserType $userType;

    public function __construct(int $username, string $name, string $password, string $email, UserType $userType) { 
        $this->username = $username;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->userType = $userType;
    }
    public function dbUpdate($db){
        $stmt = $db->prepare('UPDATE User SET name = ?, password = ?, email = ?, userType = ? WHERE username = ?');
        $stmt->execute(array($this->name, $this->password, $this->email,$this->userType, $this->username));
    }
    function getUser(string $username, PDO $db){
        $stmt = $db->prepare('SELECT * FROM User WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }
    
}
?>