<?php

$url       = explode('/', $q);
$workshopId = $url[1];

require_once('php/Workshop.php');
$workshop = Workshop::getData($workshopId);
$slots    = Workshop::getSlots($workshopId);
$map      = Workshop::generateMap($workshop->room);

if($workshop) {
    $file = 'workshop';
} else {
    $file = '404';
}