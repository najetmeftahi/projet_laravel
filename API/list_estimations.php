<?php
require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid'])&&isset($_GET['sid'])&&isset($_GET['stid'])&&isset($_GET['tid'])){
$pid = $_GET['pid'];
$sid = $_GET['sid'];
$stid = $_GET['stid'];
$tid = $_GET['tid'];

$sql = "SELECT * FROM estimations WHERE project_id = '$pid' AND sprint_id = '$sid' AND story_id = '$stid' AND task_id = '$tid'";
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