<?php
    declare(strict_types=1);

    class User{
        private const MIN_PASSWORD_LENGTH = 8;
        private const MAX_PASSWORD_LENGTH = 64;
        private const MIN_USERNAME_LENGTH = 3;
        private const MAX_USERNAME_LENGTH = 64;
        private const MIN_NAME_LENGTH = 3;
        private const MAX_NAME_LENGTH = 64;


        public string $username;
        public string $name;
        public string $email;
        private ?string $password;
        private string $hashedPassword;
        public string $userType;

        public function __construct(string $username, string $name, string $email, string $password, string $userType = 'Client', ?bool $passwordIsHashed = false) { 
            $this->username = $username;
            $this->name = $name;
            $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $this->setPassword($password, $passwordIsHashed);
            $this->userType = $userType;
        }

        public function setPassword(string $password, ?bool $passwordIsHashed = false) {
            if ($passwordIsHashed){
                $this->password = null;
                $this->hashedPassword = $password;
            } else {
                $this->password = $password;
                $this->hashedPassword = User::passwordHash($password);
            }
        }

        public function updateUser(PDO $db) : void {
            $stmt = $db->prepare('UPDATE User SET name = ?, password = ?, email = ?, userType = ? WHERE username = ?');
            $stmt->execute(array($this->name, $this->hashedPassword, $this->email, $this->userType, $this->username));
        }
        public function createUser(PDO $db) : void {
            $db = getDatabaseConnection();
            $stmt = $db->prepare('INSERT INTO User (username, name, password, email, userType) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute(array($this->username, $this->name, $this->hashedPassword, $this->email, $this->userType));
        }

        public function validateParameters(PDO $db) : ?string {
            return User::validatorUsername($this->username, $db) ??
                   User::validatorName($this->name) ??
                   User::validatorEmail($this->email) ??
                   User::validatorPassword($this->password);
        } 
        public static function getUserInfo(PDO $db, string $username) : ?User {
            $stmt = $db->prepare('SELECT * FROM User WHERE username=?');
            $stmt->execute(array($username));
            $user = $stmt->fetch();
            if ($user === false) return null;
            return new User($user['username'], $user['name'], $user['email'], $user['password'], $user['userType'], true);
        }
        public static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
            $stmt = $db->prepare('SELECT * FROM User WHERE username=? AND password=?');
            $stmt->execute(array($username, User::passwordHash($password)));
            $user = $stmt->fetch();
            if ($user === false) return null;
            return new User($user['username'], $user['name'], $user['email'], $password, $user['userType']);
        }
        public static function usernameExists(PDO $db, string $username) : bool {
            $stmt = $db->prepare('SELECT * FROM User WHERE username=?');
            $stmt->execute(array($username));
            return $stmt->fetch() !== false;
        }
        private static function emailExists(PDO $db, string $email) : bool {
            $stmt = $db->prepare('SELECT * FROM User WHERE email=?');
            $stmt->execute(array($email));
            return $stmt->fetch() !== false;
        }

        private static function passwordHash(string $password) : string {
            return sha1($password);
        }

        private static function validatorUsername(string $username, PDO $db = null) : ?string {
            $length = strlen($username);
            if ($length < User::MIN_USERNAME_LENGTH)
                return 'Username must be at least ' . User::MIN_USERNAME_LENGTH . ' long.';
            if ($length > User::MAX_USERNAME_LENGTH)
                return 'Username must be at most ' . User::MAX_USERNAME_LENGTH . ' long.';
            if (preg_match('/\s/', $username) === 1)
                return 'Username must not have spaces.';
            if (preg_match('/\W/', $username) === 1)
                return 'Username must not have special characters.';
            if ($db !== null && User::usernameExists($db, $username))
                return 'Username already taken.';
            return null;
        }

        private static function validatorName(string $name) : ?string {
            $length = strlen($name);
            if ($length < User::MIN_NAME_LENGTH)
                return 'Name must be at least ' . User::MIN_NAME_LENGTH . ' long.';
            if ($length > User::MAX_NAME_LENGTH)
                return 'Name must be at most ' . User::MAX_NAME_LENGTH . ' long.';
            return null;
        }

        private static function validatorEmail(string $email, PDO $db = null) : ?string {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                return 'E-mail is not valid.';
            if ($db !== null && User::emailExists($db, $email))
                return 'E-mail already taken.';
            return null;
        }

        private static function validatorPassword (?string $password) : ?string {
            if ($password === null) return 'Don\'t have password.';
            $length = strlen($password);
            $_SESSION['password received'] = $password;
            if ($length < User::MIN_PASSWORD_LENGTH)
                return 'Password must be at least ' . User::MIN_PASSWORD_LENGTH . ' long.';
            if ($length > User::MAX_PASSWORD_LENGTH)
                return 'Password must be at most ' . User::MAX_PASSWORD_LENGTH . ' long.';
            if (preg_match('/\s/', $password) === 1)
                return 'Password must not have spaces.';
            if (preg_match('/[a-z]/', $password) === 0)
                return 'Password must have at least one lower case letter.';
            if (preg_match('/[A-Z]/', $password) === 0)
                return 'Password must have at least one upper case letter.';
            if (preg_match('/[0-9]/', $password) === 0)
                return 'Password must have at least one digit.';
            return null;
        }
    }
?>