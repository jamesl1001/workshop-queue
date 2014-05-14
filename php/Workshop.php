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

    static function generateRequestAssistanceMap($room) {
        require('db.php');

        $sth = $dbh->query("SELECT gid FROM roomgid WHERE room='$room'");
        $sth->setFetchMode(PDO::FETCH_NUM);
        $gid = $sth->fetch();

        $csv = file_get_contents("https://docs.google.com/spreadsheets/d/1OK2yCPPgjHYV7Lj-7dHLZSu_ysnRBpX9froG70PF0xA/export?gid=$gid[0]&format=csv");

        $_SESSION['gid'] = $gid;
        $_SESSION['csv'] = $csv;

        $lines = explode("\n", $csv);

        $array = array();

        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }

        $html = '';

        $html .= '<div class="map">';

        foreach($array as $row) {
            $html .= '<div class="row">';
            foreach($row as $cell) {
                switch($cell) {
                    case '':
                        $html .= '<div class="cell cell--empty"></div>';
                        break;
                    case is_numeric($cell):
                        $html .= "<div class=\"cell cell--pc\"><input type=\"radio\" name=\"seat\" id=\"$room-$cell\" value=\"$room-$cell\"/><label for=\"$room-$cell\">$cell</label></div>";
                        break;
                    case 'D':
                        $html .= '<div class="cell cell--door" title="Door"><i class="icon-exit"></i></div>';
                        break;
                }
            }
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }
}