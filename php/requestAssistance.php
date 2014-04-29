<?php

session_start();
require('db.php');

$workshopId      = $_POST['workshopId'];
$requestName     = $_POST['requestName'];
$requestKentId   = $_POST['requestKentId'];
$requestLocation = $_POST['requestLocation'];

$sth = $dbh->prepare("INSERT INTO slots (workshopId, name, kentId, location) VALUE (:workshopId, :requestName, :requestKentId, :requestLocation)");
$sth->bindParam(':workshopId', $workshopId);
$sth->bindParam(':requestName', $requestName);
$sth->bindParam(':requestKentId', $requestKentId);
$sth->bindParam(':requestLocation', $requestLocation);
$sth->execute();

$_SESSION['mySlotId'] = $dbh->lastInsertId();