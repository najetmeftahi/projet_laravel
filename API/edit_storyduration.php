<?php
require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

/*
*** SELECT SUM(est_val) AS total_estval FROM estimations WHERE sprint_id = 1 AND story_id = 1 AND project_id = 1;
*** SELECT SUM(est_dur) AS total_est_dur FROM tasks WHERE sprint_id = 1 AND story_id = 1 AND project_id = 20;

***UPDATE
        stories
    SET
        est_dur =( SELECT SUM(est_dur) AS total_est_dur FROM tasks WHERE sprint_id = 1 AND story_id = 1 AND project_id = 20)
    WHERE
        sprint_id = 1 AND id = 1 AND project_id = 20;
*/

if(isset($_GET['pid'])&&isset($_GET['sid'])&&isset($_GET['stid'])){
$pid = $_GET['pid'];
$sid = $_GET['sid'];
$stid = $_GET['stid'];

    //Update total real
    $sql = "UPDATE
                stories
            SET
                real_dur =( SELECT SUM(real_dur) AS total_real_dur FROM tasks WHERE sprint_id = '$sid' AND story_id = '$stid' AND project_id = '$pid')
            WHERE
                project_id = '$pid' AND sprint_id = '$sid' AND id = '$stid';
    ";
    if (mysqli_query($conn, $sql)) {echo "1";} else {echo mysqli_error($conn);}

    
    //Update total estimated
    $sql = "UPDATE
                stories
            SET
                est_dur =( SELECT SUM(est_dur) AS total_est_dur FROM tasks  WHERE sprint_id = '$sid' AND story_id = '$stid' AND project_id = '$pid')
            WHERE
                project_id = '$pid' AND sprint_id = '$sid' AND id = '$stid';
                ";

    if (mysqli_query($conn, $sql)) {echo "2";} else {echo mysqli_error($conn);}








}

/*
$sql = "SELECT * FROM estimations WHERE project_id = '$pid' AND sprint_id = '$sid' AND story_id = '$stid'";
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
*/
?>

