<?php
require 'config.php';

$conn = mysqli_connect($dbs, $dbu, $dbp, $dbn);

if (1){
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $stid = $_GET['stid'];
    $tsk_resp = $_GET['resp'];
    $tsk_title = $_GET['title'];
    $tsk_goal = $_GET['goal'];
    $tsk_priority = $_GET['pr'];
    $tsk_status = $_GET['status'];



    $sql = "INSERT INTO tasks (sprint_id, project_id, story_id, assignee_id, title, goal, priority, tskstatus, est_dur, real_dur) 
    VALUES  ('$sid','$pid','$stid','$tsk_resp','$tsk_title','$tsk_goal','$tsk_priority','$tsk_status',0,0)";
    if (mysqli_query($conn, $sql)){
//////////////////////////////////////////////////////////
    $sql = "SELECT member_id FROM sprint_member WHERE project_id='$pid' AND sprint_id='$sid'";
    $result = mysqli_query($conn, $sql);
    $r = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
        foreach ($r as $rid) {
            $member_id = $rid['member_id'];

            $sql = "INSERT INTO `estimations`(
                `id`,
                `project_id`,
                `sprint_id`,
                `story_id`,
                `task_id`,
                `judge_id`,
                `est_val`
            ) VALUES(NULL, '$pid', '$sid', '$stid',(SELECT MAX(id) FROM tasks), '$member_id',0);
            ";

            if (mysqli_query($conn, $sql)){
                echo 'est added';
            }else{
                echo "Error:" . mysqli_error($conn);
            }
        }
    }
//////////////////////////////////////////////////////////  
    }
    else{
        echo "Error:" . mysqli_error($conn);
    }
}


//insert into estimations foreach member
/*
INSERT INTO `estimations`(
    `id`,
    `project_id`,
    `sprint_id`,
    `story_id`,
    `task_id`,
    `judge_id`,
    `est_val`
)
VALUES(NULL, '9', '9', '9', '9', 'MEMBER ID',0);
*/
//function load members


mysqli_close($conn);

?>
