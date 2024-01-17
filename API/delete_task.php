<?php
require 'config.php';
/*Delete Task with estimations*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid']) && isset($_GET['sid']) && isset($_GET['stid']) && isset($_GET['tid'])){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $stid = $_GET['stid'];
    $tid = $_GET['tid'];
    $sql = "DELETE FROM estimations WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid' AND task_id = '$tid'";
    if (mysqli_query($conn, $sql)) {
        echo "Task Estimations Deleted\n";

        $sql = "DELETE FROM tasks WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid' AND id = '$tid'";

        if (mysqli_query($conn, $sql)) {echo "Task Deleted\n";} else {echo "Error:".mysqli_error($conn);}


    } else {
        echo mysqli_error($conn);
    }


}

mysqli_close($conn);




?>