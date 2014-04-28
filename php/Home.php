<?php

class Home {
    static function getWorkshopsData() {
        require('db.php');

        $sth = $dbh->query("SELECT workshopId, module, type, lecturer, date, room FROM workshops ORDER BY date DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }
}