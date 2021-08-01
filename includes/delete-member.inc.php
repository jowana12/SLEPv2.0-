<?php

$org_id = isset($_GET['id'])? $_GET['id'] : "";
$stid = isset($_GET['stid'])? $_GET['stid'] : "";

$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
$statement_one = $dbh->prepare("delete from slep_db.officers where student_id=? and organization_id=?");
$statement_one->bindParam(1, $stid);
$statement_one->bindParam(2, $org_id);

$statement_two = $dbh->prepare("delete from slep_db.registrations where student_id=? and org_id=?");
$statement_two->bindParam(1, $stid);
$statement_two->bindParam(2, $org_id);

$statement_one->execute();
$statement_two->execute();

header("location: ../organization-members.php?id=".$org_id);
exit();