<?php
require 'config.php';
$conn = mysqli_connect($dbs, $dbu, $dbp, $dbn);
/*function CountStories($pid,$sid){
    global $dbs;
    global $dbu;
    global $dbp;
    global $dbn;
    $conn = mysqli_connect($dbs, $dbu, $dbp, $dbn);
    $sql = "SELECT COUNT(id) FROM stories WHERE project_id = '$pid' AND sprint_id = '$sid'";
    $result = mysqli_query($conn, $sql);
    $r = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
            $spcount = $r[0]["COUNT(id)"];
        } else {
            $spcount = 0;
    }
    return($spcount);
}*/

if (1){
    $sid = $_GET['sid'];
    $pid = $_GET['pid'];
    $st_title = $_GET['title'];
    $st_goal = $_GET['goal'];
    $st_priority = $_GET['pr'];
    $st_status = $_GET['status'];

    $sql = "INSERT INTO stories(sprint_id, project_id, title, goal, priority, ststatus, est_dur, real_dur) 
    VALUES  ('$sid','$pid','$st_title','$st_goal','$st_priority','$st_status',0,0)";
    if (mysqli_query($conn, $sql)){
        echo "New Story added";
    }
    else{
        echo "Error:" . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
