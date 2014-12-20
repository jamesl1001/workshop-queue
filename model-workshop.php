<?php

setcookie('csrf-workshop', md5(uniqid()), 0, '/');

$url       = explode('/', $q);
$workshopId = $url[1];

require_once('php/Workshop.php');
$workshop = Workshop::getData($workshopId);

if($workshop) {
    $file  = 'workshop-template';
    $slots = Workshop::getSlots($workshopId);
    $map   = Workshop::generateRequestAssistanceMap($workshop->room);
} else {
    $file = '404';
}