<?php
require 'config.php';
/*Delete Task with estimations*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid']) && isset($_GET['sid']) && isset($_GET['stid'])){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $stid = $_GET['stid'];

    //Delete Story
    $sql = "DELETE FROM stories WHERE project_id='$pid' AND sprint_id ='$sid' AND id = '$stid'";
    if (mysqli_query($conn, $sql)){echo 'Story details deleted <br>';}else{echo mysqli_error($conn);}

    //Delete Story Tasks
    $sql = "DELETE FROM tasks WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid'";
    if (mysqli_query($conn, $sql)){echo 'Story details deleted ';}else{echo mysqli_error($conn);}

    //Delete Story Estimations
    $sql = "DELETE FROM estimations WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid'";
    if (mysqli_query($conn, $sql)){echo 'Story details deleted <br>';}else{echo mysqli_error($conn);}

}

mysqli_close($conn);




?>