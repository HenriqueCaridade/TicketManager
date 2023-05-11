<?php
    declare(strict_types=1);

    class User {
        protected const MIN_PASSWORD_LENGTH = 8;
        protected const MAX_PASSWORD_LENGTH = 64;
        protected const MIN_USERNAME_LENGTH = 3;
        protected const MAX_USERNAME_LENGTH = 64;
        protected const MIN_NAME_LENGTH = 3;
        protected const MAX_NAME_LENGTH = 64;


        public string $username;
        public string $name;
        public string $email;
        public string $userType;

        private function __construct(string $username, string $name, string $email, string $userType = 'Client') { 
            $this->username = $username;
            $this->name = $name;
            $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $this->userType = $userType;
        }

        public static function getUser(PDO $db, string $username) : ?User {
            $stmt = $db->prepare('SELECT * FROM User WHERE username=?');
            $stmt->execute(array($username));
            $user = $stmt->fetch();
            if ($user === false) return null;
            return new User($user['username'], $user['name'], $user['email'], $user['userType']);
        }
        public static function getUserPassword(PDO $db, string $username) : ?string {
            $stmt = $db->prepare('SELECT password FROM User WHERE username=?');
            $stmt->execute(array($username));
            $user = $stmt->fetch();
            if ($user === false) return null;
            return $user['password'];
        }
        public static function updateUserParameters(PDO $db, string $currUsername, string $newUsername, string $newName, string $newEmail) : void {
            $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
            $stmt = $db->prepare('UPDATE User SET username = ?, name = ?, email = ? WHERE username = ?');
            $stmt->execute(array($newUsername, $newName, $newEmail, $currUsername));
        }
        public static function updateUserPassword(PDO $db, string $username, string $password) : void {
            $stmt = $db->prepare('UPDATE User SET password = ? WHERE username = ?');
            $stmt->execute(array(User::passwordHash($password), $username));
        }
        public static function createUser(PDO $db, string $username, string $name, string $password, string $email, string $userType = 'Client') : void {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $stmt = $db->prepare('INSERT INTO User (username, name, password, email, userType) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute(array($username, $name, User::passwordHash($password), $email, $userType));
        }

        public static function usernameExists(PDO $db, string $username) : bool {
            $stmt = $db->prepare('SELECT * FROM User WHERE username=?');
            $stmt->execute(array($username));
            return $stmt->fetch() !== false;
        }
        protected static function emailExists(PDO $db, string $email) : bool {
            $stmt = $db->prepare('SELECT * FROM User WHERE email=?');
            $stmt->execute(array($email));
            return $stmt->fetch() !== false;
        }

        public static function validateParameters(PDO $db, string $username, string $name, string $password, string $email, string $userType = 'Client') : ?string {
            return User::validatorUsername($username, $db) ??
                   User::validatorName($name) ??
                   User::validatorEmail($email) ??
                   User::validatorPassword($password) ?? 
                   User::validatorUserType($userType);
        }
        public static function validateUpdateParameters(PDO $db, string $username, string $name, string $email) : ?string {
            return User::validatorUsername($username, $db) ??
                   User::validatorName($name) ??
                   User::validatorEmail($email);
        }
        public static function validateUpdatePassword (PDO $db, string $username, string $password) : ?string {
            if (User::passwordMatchesHash($password, User::getUserPassword($db, $username)))
                return 'Cannot change to password already in use!';
            return User::validatorPassword($password);
        }
        protected static function validatorUsername(string $username, PDO $db = null) : ?string {
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
        protected static function validatorName(string $name) : ?string {
            $length = strlen($name);
            if ($length < User::MIN_NAME_LENGTH)
                return 'Name must be at least ' . User::MIN_NAME_LENGTH . ' long.';
            if ($length > User::MAX_NAME_LENGTH)
                return 'Name must be at most ' . User::MAX_NAME_LENGTH . ' long.';
            return null;
        }
        protected static function validatorEmail(string $email, PDO $db = null) : ?string {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                return 'E-mail is not valid.';
            if ($db !== null && User::emailExists($db, $email))
                return 'E-mail already taken.';
            return null;
        }
        protected static function validatorPassword(string $password) : ?string {
            if ($password === null) return 'Don\'t have password.';
            $length = strlen($password);
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
        protected static function validatorUserType(string $userType) : ?string {
            if (!in_array($userType, array('Client', 'Agent', 'Admin')))
                return 'Invalid User Type.';
            return null;
        }

        public static function passwordMatchesHash(string $password, string $hashedPassword) : bool {
            return User::passwordHash($password) === $hashedPassword;
        }
        protected static function passwordHash(string $password) : string {
            return sha1($password);
        }
    }
?>