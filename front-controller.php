<?php
ob_start();
session_start();

$q = $_GET['q'];

$path = preg_replace('/\/$|.php/', '', $q);

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path.php")) {          // PAGE
    $file = $path;
} elseif($path == 'admin') {
    $file = 'admin/index';
} else {                                            // NOT FOUND
    $file = '404';
}

$isHome     = ($q == '');
$isWorkshop = preg_match('#workshop\/\d+/?$#', $q);

if($isHome) {
    require_once('model-home.php');
}

if($isWorkshop) {
    require_once('model-workshop.php');
}

require_once('front-view.php');