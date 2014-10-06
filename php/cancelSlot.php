<?php

require('db.php');

$slotId = $_POST['slotId'];

$cancelled = date("Y-m-d H:i:s");

$sth = $dbh->prepare("UPDATE slots SET active=0, cancelled=:cancelled WHERE slotId=$slotId");
$sth->bindParam(':cancelled', $cancelled);
$sth->execute();