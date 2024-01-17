<?php
require 'config.php';
/*Store PROJECTS*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(1){
            //$pj_id = $_GET['pid'];
            $pj_title = $_GET['title'];
            $pj_goal = $_GET['goal'];
            $pj_descr = $_GET['descr'];
            $pj_sdate = $_GET['sdate'];
            $pj_edate = $_GET['edate'];
            $pj_owner = $_GET['owner'];
            $pj_status = $_GET['status'];
            $pj_member_count = $_GET['mc'];

            $sql = "INSERT INTO projects (title,goal,descr,sdate,edate,powner,pstatus,member_count) 
                    VALUES (
                            '$pj_title',
                            '$pj_goal',
                            '$pj_descr',
                            '$pj_sdate',
                            '$pj_edate',
                            '$pj_owner',
                            '$pj_status',
                            '$pj_member_count')";
                            if (mysqli_query($conn, $sql)) {echo "New project added";} else {echo "Error:".mysqli_error($conn);}
}

mysqli_close($conn);




?>