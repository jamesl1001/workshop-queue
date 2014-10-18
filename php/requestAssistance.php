<?php

session_start();

require('db.php');
require('ProfanityFilter.php');

$workshopId    = $_POST['workshopId'];
$requestName   = $_POST['requestName'];
$requestSeat   = $_POST['requestSeat'];

if(ProfanityFilter::containsProfanity($requestName)) {
    echo 'profanity';
} else {
    $sth = $dbh->query("SELECT name, seat FROM slots WHERE workshopId='$workshopId' AND status=0 AND (name='$requestName' OR seat='$requestSeat')");
    $sth->setFetchMode(PDO::FETCH_OBJ);
    $result = $sth->fetch();

    $created   = date("Y-m-d H:i:s");
    $assisting = '0000-00-00 00:00:00';
    $cancelled = '0000-00-00 00:00:00';

    if(!$result) {
        $sth = $dbh->prepare("INSERT INTO slots (workshopId, name, seat, status, created, assisting, cancelled) VALUE (:workshopId, :requestName, :requestSeat, 0, :created, :assisting, :cancelled)");
        $sth->bindParam(':workshopId', $workshopId);
        $sth->bindParam(':requestName', $requestName);
        $sth->bindParam(':requestSeat', $requestSeat);
        $sth->bindParam(':assisting', $assisting);
        $sth->bindParam(':created', $created);
        $sth->bindParam(':cancelled', $cancelled);
        $sth->execute();

        $_SESSION['mySlotId'] = $dbh->lastInsertId();
    } else {
        echo 'duplicate';
    }
}