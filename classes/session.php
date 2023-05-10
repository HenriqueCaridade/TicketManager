<?php
    declare(strict_types=1);
    class Session {
        const TOAST = 'toast';
        const SUCCESS = 'success';
        const ERROR = 'error';
        const INPUT = 'input';
        const R_USERNAME = 'register username';
        const R_NAME = 'register name';
        const R_EMAIL = 'register email';
        const R_PASSWORD1 = 'register password1';
        const R_PASSWORD2 = 'register password2';
        const L_USERNAME = 'login username';
        const L_PASSWORD = 'login password';
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

        public function addToast(string $type, string $message) : void {
            $this->pendingToasts[$type][] = $message;
        }

        public function fetchErrorToasts() : array {
            $ret = $this->pendingToasts[Session::ERROR] ?? array();
            unset($this->pendingToasts[Session::ERROR]);
            return $ret;
        }
        public function fetchSuccessToasts() : array {
            $ret = $this->pendingToasts[Session::SUCCESS] ?? array();
            unset($this->pendingToasts[Session::SUCCESS]);
            return $ret;
        }
    }
?>