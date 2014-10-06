<?php

session_start();
require('db.php');

$workshopId    = $_POST['workshopId'];
$requestName   = $_POST['requestName'];
$requestSeat   = $_POST['requestSeat'];

$sth = $dbh->query("SELECT name, seat FROM slots WHERE workshopId='$workshopId' AND active=1 AND name='$requestName' OR seat='$requestSeat'");
$sth->setFetchMode(PDO::FETCH_OBJ);
$result = $sth->fetch();

$created   = date("Y-m-d H:i:s");
$cancelled = '0000-00-00 00:00:00';

if(!$result) {
    $sth = $dbh->prepare("INSERT INTO slots (workshopId, name, seat, active, created, cancelled) VALUE (:workshopId, :requestName, :requestSeat, 1, :created, :cancelled)");
    $sth->bindParam(':workshopId', $workshopId);
    $sth->bindParam(':requestName', $requestName);
    $sth->bindParam(':requestSeat', $requestSeat);
    $sth->bindParam(':created', $created);
    $sth->bindParam(':cancelled', $cancelled);
    $sth->execute();

    $_SESSION['mySlotId'] = $dbh->lastInsertId();
} else {
    echo 'duplicate';
}