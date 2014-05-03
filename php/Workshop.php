<?php

class Workshop {
    static function getData($id) {
        require('db.php');

        $sth = $dbh->query("SELECT workshopId, timestamp, module, type, lecturer, date, room, time FROM workshops WHERE workshopId='$id'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }

    static function getSlots($id) {
        require('db.php');

        $sth = $dbh->query("SELECT slotId, name, kentId, seat FROM slots WHERE workshopId='$id'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }

    static function getSeats($id) {
        return simplexml_load_file("layouts/$id.xml");
    }
}