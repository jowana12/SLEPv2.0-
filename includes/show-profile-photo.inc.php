<?php
session_start();

$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from slep_db.users where id_number=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:'.$row['mime']);
echo $row['data'];