<?php

session_start();

require('db.php');

$slotId = $_POST['slotId'];

$assisting = date("Y-m-d H:i:s");

$sth = $dbh->prepare("UPDATE slots SET status=1, assisting=:assisting WHERE slotId=$slotId");
$sth->bindParam(':assisting', $assisting);
$sth->execute();