<?php
require 'config.php';
/*
SELECT
    id,
    firstname,
    lastname
FROM
    members
LEFT JOIN sprint_member ON members.id = sprint_member.member_id
WHERE
    sprint_member.project_id = 6

*/
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
if(isset($_GET['pid']) && isset($_GET['sid'])){
    /*add project id validation */
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $sql = "SELECT id,firstname, lastname FROM members LEFT JOIN sprint_member ON members.id = sprint_member.member_id WHERE sprint_member.project_id = '$pid' AND sprint_member.sprint_id = '$sid'";
$result = mysqli_query($conn, $sql);
$r = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $r[] = $row;
    }
    $json = json_encode($r);
    print($json);
} else {
    echo "[]";
}
mysqli_close($conn);

}
?>