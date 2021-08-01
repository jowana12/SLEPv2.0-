<?php

$id = isset($_GET['id'])? $_GET['id'] : "";
$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");

$reg = $dbh->prepare("select * from slep_db.registrations where reg_id=?");
$reg->bindParam(1, $id);
$reg->execute();
$org_id = $reg->fetch();


$statement = $dbh->prepare("delete from slep_db.registrations where reg_id=?");
$statement->bindParam(1, $id);
$statement->execute();

header("location: ../organization-members-approval.php?id=".$org_id['org_id']);
exit();