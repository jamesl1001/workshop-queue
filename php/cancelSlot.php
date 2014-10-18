<?php

session_start();

require('db.php');

$slotId = $_POST['slotId'];

$cancelled    = date("Y-m-d H:i:s");
$whoCancelled = (isset($_SESSION['admin']) ? 'admin' : 'user');

$sth = $dbh->prepare("UPDATE slots SET status=2, cancelled=:cancelled, whoCancelled=:whoCancelled WHERE slotId=$slotId");
$sth->bindParam(':cancelled', $cancelled);
$sth->bindParam(':whoCancelled', $whoCancelled);
$sth->execute();