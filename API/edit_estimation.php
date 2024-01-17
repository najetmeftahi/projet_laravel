<?php
require 'config.php';
/*EDIT estimation*/
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid']) && isset($_GET['sid']) && isset($_GET['stid']) && isset($_GET['tid']) && isset($_GET['jid']) && isset($_GET['newval'])){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $stid = $_GET['stid'];
    $tid = $_GET['tid'];
    $jid = $_GET['jid'];
    $newval = $_GET['newval'];
    $sql = "UPDATE estimations SET est_val='$newval' WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid' AND task_id = '$tid' AND judge_id = '$jid'";
    if (mysqli_query($conn, $sql)) {
        echo "Task updated \n";
        /*updating total est*/
        $sql = "SELECT est_val from estimations WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid' AND task_id = '$tid'";
        $result = mysqli_query($conn, $sql);
        $r = array();
        if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $r[] = $row;
        }
        $m = 0;
        $c = 0;
        $t = 0;
        foreach ($r as $k => $estval) {
            $est = $estval['est_val'];
            if($est != 0){
                $c++;
                $t = $t+$est;
            }
        }
        $m = ceil($t/$c);
        //print($m);
        $sql = "UPDATE tasks SET est_dur ='$m' WHERE project_id='$pid' AND sprint_id ='$sid' AND story_id = '$stid' AND id = '$tid'";
        if (mysqli_query($conn, $sql)){echo "Task Est updated \n";}
        } else {
        echo "[]";
        }
        /*updating total est*/

    } else {
        echo "Error:".mysqli_error($conn);
    }


}

mysqli_close($conn);




?>