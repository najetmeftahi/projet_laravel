<?php
require 'config.php';
/*Delete PROJECT MEMBER*/
/*
DELETE m1 FROM members AS m1 INNER JOIN assist AS a1 ON m1.id = a1.member_id WHERE a1.project_id = 2;
*/
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['mid'])){
            $member_id = $_GET['mid'];
            $project_id = $_GET['pid'];
            $sql = "DELETE FROM assist WHERE member_id = '$member_id' AND project_id='$project_id'";
            //add delete from assist

            if (mysqli_query($conn, $sql)) {
                echo "Member $member_id deleted From Project $project_id";
            } else {
                echo "Error:".mysqli_error($conn);
            }

}

mysqli_close($conn);




?>