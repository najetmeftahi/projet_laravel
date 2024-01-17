<?php
require 'config.php';
/*
SELECT
    id,
    firstname,
    lastname
FROM
    members
LEFT JOIN assist ON members.id = assist.member_id
WHERE
    assist.project_id = 2

*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
if(isset($_GET['pid'])){
    /*add project id validation */
    $pid = $_GET['pid'];
    $sql = "SELECT id,firstname,lastname,mrole,project_id FROM members LEFT JOIN assist ON members.id = assist.member_id WHERE assist.project_id = '$pid'";
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