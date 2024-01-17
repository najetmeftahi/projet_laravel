<?php
require 'config.php';
$conn = mysqli_connect($dbs, $dbu, $dbp, $dbn);
//check for  isset
if (1){
    $pid = $_GET['pid'];
    $sp_title = $_GET['title'];
    $sp_goal = $_GET['goal'];
    $sp_sdate = $_GET['sdate'];
    $sp_edate = $_GET['edate'];
    $sp_lasts = $_GET['lasts'];
    $sp_memids = $_GET['members'];
    $sp_descr = $_GET['descr'];
    $sp_status = $_GET['status'];
    //print_r(json_decode($sp_memids));
    $sql = "INSERT INTO sprints (project_id, title, goal, sdate, edate, dur, spstatus, descr)
    VALUES ('$pid',
            '$sp_title',
            '$sp_goal',
            '$sp_sdate',
            '$sp_edate',
            '$sp_lasts',
            '$sp_status',
            '$sp_descr'
            )";
    if (mysqli_query($conn, $sql)){echo "New Sprint added";
    
        foreach ((json_decode($sp_memids)) as $key => $member_id) {
            //////WHYYYYYYYYY -1
            $sql = "INSERT INTO sprint_member (member_id, sprint_id, project_id)
            VALUES ('$member_id',(SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'sprints' AND table_schema = '$dbn')-1,$pid)";
            if (mysqli_query($conn, $sql)){
                echo "Member added";
            }else{
                echo "Error:" . mysqli_error($conn);
            }
    
        }

    }else{echo "Error:" . mysqli_error($conn);}



}

mysqli_close($conn);

?>
