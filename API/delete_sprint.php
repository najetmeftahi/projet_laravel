<?php
require 'config.php';
/*Delete Task with estimations*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid']) && isset($_GET['sid'])){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];

    //Delete Sprint
    $sql = "DELETE FROM sprints WHERE project_id='$pid' AND id ='$sid'";
    if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

    //Delete Sprint_members
    $sql = "DELETE FROM sprint_member WHERE project_id='$pid' AND sprint_id ='$sid'";
    if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

    //Delete Sprint stories
    $sql = "DELETE FROM stories WHERE project_id='$pid' AND sprint_id ='$sid'";
    if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

    //Delete Sprint Story Tasks
    $sql = "DELETE FROM tasks WHERE project_id='$pid' AND sprint_id ='$sid'";
    if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

    //Delete  Sprint Story task Estimations
    $sql = "DELETE FROM estimations WHERE project_id='$pid' AND sprint_id ='$sid'";
    if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

}

mysqli_close($conn);




?>