<?php
require 'config.php';
/*Edit PROJECTS*/
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

$pj_id = $_GET['pid'];
$pj_title = $_GET['title'];
$pj_goal = $_GET['goal'];
$pj_descr = $_GET['descr'];
$pj_sdate = $_GET['sdate'];
$pj_edate = $_GET['edate'];
$pj_owner = $_GET['owner'];
$pj_status = $_GET['status'];

$sql = "UPDATE projects SET title = '$pj_title', goal = '$pj_goal', descr = '$pj_descr', sdate = '$pj_sdate', edate = '$pj_edate', powner='$pj_owner', pstatus = '$pj_status' WHERE id = '$pj_id'";

if (mysqli_query($conn, $sql)) {echo "project edited";} else {echo "Error:".mysqli_error($conn);}


mysqli_close($conn);




?>