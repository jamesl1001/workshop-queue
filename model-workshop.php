<?php

$url       = explode('/', $q);
$workshopId = $url[1];

require_once('php/Workshop.php');
$workshop = Workshop::getWorkshopData($workshopId);
$slots    = Workshop::getWorkshopSlots($workshopId);

if($workshop) {
    $file = 'workshop';
} else {
    $file = '404';
}