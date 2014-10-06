<?php

require('db.php');

$workshopId = $_POST['workshopId'];

$ended = date("Y-m-d H:i:s");

$sth = $dbh->prepare("UPDATE workshops SET active=0, ended=:ended WHERE workshopId=$workshopId");
$sth->bindParam(':ended', $ended);
$sth->execute();