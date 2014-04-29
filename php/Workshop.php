<?php

class Workshop {
    static function getWorkshopData($id) {
        require('db.php');

        $sth = $dbh->query("SELECT workshopId, timestamp, module, type, lecturer, date, room, time FROM workshops WHERE workshopId='$id'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }

    static function getWorkshopSlots($id) {
        require('db.php');

        $sth = $dbh->query("SELECT slotId, name, kentId, location FROM slots WHERE workshopId='$id' ORDER BY slotId DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }
}