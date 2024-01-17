<?php
require 'config.php';
$conn = mysqli_connect($dbs, $dbu, $dbp, $dbn);

if ((isset($_POST['action']))&&(!empty($_POST['action']))){
    if($_POST['action'] == 'addofftask'){
        //die($_POST['action']);
        if( isset($_POST['pid']) 
            && isset($_POST['sid']) 
            && isset($_POST['resp']) 
            && isset($_POST['title']) 
            && isset($_POST['status']) 
            && isset($_POST['dur'])
          ){
            $pid = $_POST['pid']; $sid = $_POST['sid']; 
            $off_resp = $_POST['resp']; $off_title = $_POST['title']; 
            $off_status = $_POST['status']; $off_duration = $_POST['dur'];

            $sql = "INSERT INTO off_tasks (project_id,sprint_id,assignee_id,title,tskstatus,duration) 
                    VALUES  ('$pid','$sid','$off_resp','$off_title','$off_status','$off_duration')";
            if (mysqli_query($conn, $sql)){echo 'done';}

        }
    }
}

    if($_POST['action'] == 'updateofftask'){
        if(isset($_POST['pid']) && isset($_POST['sid']) && isset($_POST['uid']) && isset($_POST['tid']) && isset($_POST['for']) && isset($_POST['newval'])){
            $pid = $_POST['pid'];
            $sid = $_POST['sid'];
            $tid = $_POST['tid'];
            $uid = $_POST['uid'];
            $field = $_POST['for'];
            $newval = $_POST['newval'];
            
            $sql = "UPDATE off_tasks SET $field = '$newval' WHERE project_id='$pid' AND sprint_id ='$sid' AND assignee_id = '$uid' AND id = '$tid'";
        
            if (mysqli_query($conn, $sql)) {die ('Task updated');}else {die("Error:".mysqli_error($conn));}
        }
    }


    if($_POST['action'] == 'deleteofftask'){
        if(isset($_POST['pid']) && isset($_POST['sid']) && isset($_POST['uid']) && isset($_POST['tid'])){
            $pid = $_POST['pid']; $sid = $_POST['sid'];$uid = $_POST['uid']; $tid = $_POST['tid'];
            $sql = "DELETE FROM `off_tasks` WHERE project_id = '$pid' AND sprint_id = '$sid' AND assignee_id = '$uid' AND id = '$tid'";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {die('deleted');}
        }
    }


    if($_POST['action'] == 'loadofftasks'){
        if(isset($_POST['pid']) && isset($_POST['sid'])){
            $pid = $_POST['pid']; $sid = $_POST['sid'];
            $res = array();
            $sql = "SELECT id,firstname, lastname FROM members LEFT JOIN sprint_member ON members.id = sprint_member.member_id WHERE sprint_member.project_id = '$pid' AND sprint_member.sprint_id = '$sid'";
            $result = mysqli_query($conn, $sql);
            $members = array();
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                $members[] = $row;
                }

                foreach ($members as $k => $member) {
                    $res[$member['id']]['fullname'] = $member['firstname'].' '.$member['lastname'];
                    $res[$member['id']]['tasks'] = [];
                    $res[$member['id']]['total_duration'] = 0;
                    $res[$member['id']]['done_duration'] = 0;
                    $assignee_id = intval($member['id']);
                    $sql2 = "SELECT * FROM `off_tasks` WHERE project_id = '$pid' AND sprint_id = '$sid' AND assignee_id = '$assignee_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $tasks = array();
                    if (mysqli_num_rows($result2) > 0) {
                        while($row2 = mysqli_fetch_assoc($result2)) {
                        $tasks[] = $row2;
                        }
                    }
                    foreach ($tasks as $key => $task) {
                        $res[$member['id']]['tasks'][$task['id']]['taskid'] = $task['id'];
                        $res[$member['id']]['tasks'][$task['id']]['title'] = $task['title'];
                        $res[$member['id']]['tasks'][$task['id']]['status'] = $task['tskstatus'];
                        $res[$member['id']]['tasks'][$task['id']]['duration'] = $task['duration'];
                        $res[$member['id']]['total_duration'] += intval($res[$member['id']]['tasks'][$task['id']]['duration']);
                        if(($res[$member['id']]['tasks'][$task['id']]['status']) == 3){
                            $res[$member['id']]['done_duration'] += intval($res[$member['id']]['tasks'][$task['id']]['duration']);
                        }
                    }

                }

                $json = json_encode($res);
                print($json);

                } else {
            echo "[]";
            }
        }else{
            die('[]');
        }
    }













mysqli_close($conn);
?>


