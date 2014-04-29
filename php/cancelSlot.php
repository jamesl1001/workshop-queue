<?php

require('db.php');

$slotId = $_POST['slotId'];

$sth = $dbh->prepare("DELETE FROM slots WHERE slotId=:slotId");
$sth->bindParam(':slotId', $slotId);
$result = $sth->execute();