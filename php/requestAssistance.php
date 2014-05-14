<?php

session_start();
require('db.php');

$workshopId    = $_POST['workshopId'];
$requestName   = $_POST['requestName'];
$requestKentId = $_POST['requestKentId'];
$requestSeat   = $_POST['requestSeat'];

$sth = $dbh->query("SELECT seat FROM slots WHERE seat='$requestSeat'");
$sth->setFetchMode(PDO::FETCH_OBJ);
$result = $sth->fetch();

if(!$result) {
    $sth = $dbh->prepare("INSERT INTO slots (workshopId, name, kentId, seat) VALUE (:workshopId, :requestName, :requestKentId, :requestSeat)");
    $sth->bindParam(':workshopId', $workshopId);
    $sth->bindParam(':requestName', $requestName);
    $sth->bindParam(':requestKentId', $requestKentId);
    $sth->bindParam(':requestSeat', $requestSeat);
    $sth->execute();

    $_SESSION['mySlotId'] = $dbh->lastInsertId();
} else {
    echo 'duplicate';
}