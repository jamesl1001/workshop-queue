<?php

session_start();

$room = $_POST['room'];
$seat = $_POST['seat'];

$gid = $_SESSION['gid'];
$csv = $_SESSION['csv'];

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
                if($cell == $seat) {
                    $html .= "<div class=\"cell cell--pc cell--active\"><div class=\"cell-label\">$cell</div></div>";
                } else {
                    $html .= "<div class=\"cell cell--pc\"><div class=\"cell-label\">$cell</div></div>";
                }
                break;
            case 'D':
                $html .= '<div class="cell cell--door" title="Door"><i class="icon-exit"></i></div>';
                break;
        }
    }
    $html .= '</div>';
}

$html .= '</div>';

echo $html;