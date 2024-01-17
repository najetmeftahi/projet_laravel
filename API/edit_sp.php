<?php
require 'config.php';
/*EDIT SPRINT*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['sid']) && isset($_GET['pid'])){
    $sid = $_GET['sid'];
    $pid = $_GET['pid'];
    $sp_title = $_GET['title'];
    $sp_goal = $_GET['goal'];
    $sp_sdate = $_GET['sdate'];
    $sp_edate = $_GET['edate'];
    $sp_lasts = $_GET['lasts'];
    $sp_descr = $_GET['descr'];
    $sp_status = $_GET['status'];

    $sql = "UPDATE
            sprints
            SET
            title = '$sp_title',
            goal = '$sp_goal',
            sdate = '$sp_sdate',
            edate = '$sp_edate',
            dur = '$sp_lasts',
            spstatus = '$sp_status',
            descr = '$sp_descr'
            WHERE
            project_id='$pid' AND id='$sid'
            ";

    if (mysqli_query($conn, $sql)) {
        echo "Sprint $sid modified <br>";
    } else {
        echo "Error:".mysqli_error($conn);
    }

    /* Add Update members Hereeeeeeeeeeeeeeeeee
        $sql = "UPDATE assist SET mrole='$new_mrole' WHERE member_id = '$member_id'";
        if (mysqli_query($conn, $sql)) {
        echo "Member $member_id modified <br>";
        } else {
        echo "Error:".mysqli_error($conn);
        }
    */

}

mysqli_close($conn);




?>