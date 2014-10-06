<?php

class Home {
    static function getWorkshopsData() {
        require('db.php');

        $sth = $dbh->query("SELECT workshopId, moduleCode, moduleName, type, lecturer, date, room FROM workshops WHERE active=1 ORDER BY date DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }
}