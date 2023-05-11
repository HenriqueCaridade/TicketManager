<?php
    declare(strict_types=1);
    include_once('../classes/user.php');
    class Session {
        const TOAST = 'toast';
        const SUCCESS = 'success';
        const WARNING = 'warning';
        const ERROR = 'error';
        const INPUT = 'input';
        const R_USERNAME = 'register username';
        const R_NAME = 'register name';
        const R_EMAIL = 'register email';
        const R_PASSWORD1 = 'register password1';
        const R_PASSWORD2 = 'register password2';
        const L_USERNAME = 'login username';
        const L_PASSWORD = 'login password';
        const U_USERNAME = 'update username';
        const U_NAME = 'update name';
        const U_EMAIL = 'update email';
        const U_CURR_PASSWORD = 'update curr-password';
        const U_PASSWORD1 = 'update password1';
        const U_PASSWORD2 = 'update password2';
        const USERNAME = 'username';
        const NAME = 'name';
        const EMAIL = 'email';
        const USERTYPE = 'userType';

        static ?Session $instance = null;

        private array $pendingToasts;
        private function __construct() {
            session_start();
            $this->pendingToasts = $_SESSION[Session::TOAST] ?? array();
            unset($_SESSION[Session::TOAST]);
        }
        public function __destruct() {
            $_SESSION[Session::TOAST] = $this->pendingToasts;
        }

        static function getSession() : Session {
            if (static::$instance === null)
                static::$instance = new Session();
            return static::$instance;
        }
        
        public function saveInput(string $attrib, string $value) : void {
            $_SESSION[Session::INPUT][$attrib] = $value;
        }
        public function getSavedInput(string $attrib) : ?string {
            return $_SESSION[Session::INPUT][$attrib];
        }
        public function clearInput() : void {
            unset($_SESSION[Session::INPUT]);
        }

        public function isLoggedIn() : bool {
            return isset($_SESSION[Session::USERNAME]);
        }

        public function logInUser(User $user) : void {
            $_SESSION[Session::USERNAME] = $user->username;
            $_SESSION[Session::NAME]     = $user->name;
            $_SESSION[Session::EMAIL]    = $user->email;
            $_SESSION[Session::USERTYPE] = $user->userType;
        }

        public function logOut() : void {
            unset($_SESSION[Session::USERNAME]);
            unset($_SESSION[Session::NAME]);
            unset($_SESSION[Session::EMAIL]);
            unset($_SESSION[Session::USERTYPE]);
        }

        public function addToast(string $type, string $message) : void {
            $this->pendingToasts[$type][] = $message;
        }

        public function fetchErrorToasts() : array {
            $ret = $this->pendingToasts[Session::ERROR] ?? array();
            unset($this->pendingToasts[Session::ERROR]);
            return $ret;
        }
        public function fetchWarningToasts() : array {
            $ret = $this->pendingToasts[Session::WARNING] ?? array();
            unset($this->pendingToasts[Session::WARNING]);
            return $ret;
        }
        public function fetchSuccessToasts() : array {
            $ret = $this->pendingToasts[Session::SUCCESS] ?? array();
            unset($this->pendingToasts[Session::SUCCESS]);
            return $ret;
        }
    }
?>