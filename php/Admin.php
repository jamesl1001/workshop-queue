<?php

class Admin {
    static function login($pwd) {
        require_once('hash.php');

        if($hash === hash('sha256', $pwd)) {
            $_SESSION['admin'] = true;
            header('location: /');
        } else {
            return '<p class="error">Wrong password.</p>';
        }
    }

    static function logout() {
        unset($_SESSION['admin']);
        header('location: /');
    }
}