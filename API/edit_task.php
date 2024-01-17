<?php
require 'config.php';
/*EDIT Task*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid']) && isset($_GET['sid']) && isset($_GET['stid']) && isset($_GET['tid']) && isset($_GET['for']) && isset($_GET['newval'])){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $stid = $_GET['stid'];
    $tid = $_GET['tid'];
    $field = $_GET['for'];
    $newval = $_GET['newval'];
    
    $sql = "UPDATE tasks SET $field = '$newval' WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid' AND id = '$tid'";

    if (mysqli_query($conn, $sql)) {
        echo "Task updated \n";
    } else {
        echo "Error:".mysqli_error($conn);
    }


}

mysqli_close($conn);




?>