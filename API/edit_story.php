<?php
require 'config.php';
/*EDIT SPRINT*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid']) && isset($_GET['sid']) && isset($_GET['stid']) && isset($_GET['for']) && isset($_GET['newval'])){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $stid = $_GET['stid'];
    $field = $_GET['for'];
    $newval = $_GET['newval'];
    
    $sql = "UPDATE stories SET $field = '$newval' WHERE project_id='$pid' AND sprint_id ='$sid' AND id = '$stid'";

    if (mysqli_query($conn, $sql)) {
        echo "Story modified \n";
    } else {
        echo "Errorx:".mysqli_error($conn);
    }


}

mysqli_close($conn);




?>