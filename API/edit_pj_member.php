<?php
require 'config.php';
/*EDIT PROJECT MEMBER*/
/*
DELETE m1 FROM members AS m1 INNER JOIN assist AS a1 ON m1.id = a1.member_id WHERE a1.project_id = 2;
*/
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['mid'])){
            $member_id = $_GET['mid'];
            $new_fname = $_GET['mfn'];
            $new_lname = $_GET['mln'];
            $new_mrole = $_GET['mmr'];
            $sql = "UPDATE members SET firstname = '$new_fname', lastname = '$new_lname' WHERE id = '$member_id'";

            if (mysqli_query($conn, $sql)) {
                echo "Member $member_id modified <br>";
            } else {
                echo "Error:".mysqli_error($conn);
            }

            $sql = "UPDATE assist SET mrole='$new_mrole' WHERE member_id = '$member_id'";
            if (mysqli_query($conn, $sql)) {
                echo "Member $member_id modified <br>";
            } else {
                echo "Error:".mysqli_error($conn);
            }


}

mysqli_close($conn);




?>