<?php


$id = isset($_GET['id'])? $_GET['id'] : "";

$member = "Member";
$upper = strtoupper($member);
$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");

$update_stat = $dbh->prepare("update slep_db.registrations set p_status=? where reg_id=?");
$update_stat->bindParam(1, $upper);
$update_stat->bindParam(2, $id);
$update_stat->execute();

$stat = $dbh->prepare("select * from slep_db.registrations where reg_id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();

$user_stat = $dbh->prepare("select * from slep_db.users where id_number=?");
$user_stat->bindParam(1, $row['student_id']);
$user_stat->execute();
$user_row = $user_stat->fetch();

$org_stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
$org_stat->bindParam(1, $row['org_id']);
$org_stat->execute();
$org_row = $org_stat->fetch();

$add_stat = $dbh->prepare("insert into slep_db.officers values('', ?, ?, ?, ?, ?, ?, ?)");
$add_stat->bindParam(1, $row['student_id']);
$add_stat->bindParam(2, $user_row['firstname']);
$add_stat->bindParam(3, $user_row['middlename']);
$add_stat->bindParam(4, $user_row['lastname']);
$add_stat->bindParam(5, $org_row['organization_abb']);
$add_stat->bindParam(6, $row['org_id']);
$add_stat->bindParam(7, $member);
$add_stat->execute();


header("location: ../organization-members-approval.php?id=".$row['org_id']);
exit();