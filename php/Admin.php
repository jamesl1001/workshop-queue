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

    static function newWorkshop($moduleCode, $moduleName, $type, $lecturer, $date, $room, $time) {
        require_once('db.php');

        $created = date("Y-m-d H:i:s");
        $ended   = '0000-00-00 00:00:00';

        $sth = $dbh->prepare("INSERT INTO workshops (moduleCode, moduleName, type, lecturer, date, room, time, active, created, ended) value (:moduleCode, :moduleName, :type, :lecturer, :date, :room, :time, 1, :created, :ended)");
        $sth->bindParam(':moduleCode', $moduleCode);
        $sth->bindParam(':moduleName', $moduleName);
        $sth->bindParam(':type', $type);
        $sth->bindParam(':lecturer', $lecturer);
        $sth->bindParam(':date', $date);
        $sth->bindParam(':room', $room);
        $sth->bindParam(':time', $time);
        $sth->bindParam(':created', $created);
        $sth->bindParam(':ended', $ended);
        $sth->execute();

        return $dbh->lastInsertId();
    }
}