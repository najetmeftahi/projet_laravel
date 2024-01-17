<?php
require 'config.php';
/*Store PROJECTS*/
/*
DELETE m1 FROM members AS m1 INNER JOIN assist AS a1 ON m1.id = a1.member_id WHERE a1.project_id = 2;
*/
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['pid'])){
            $pid = $_GET['pid'];

            $sql = "DELETE m1 FROM members AS m1 INNER JOIN assist AS a1 ON m1.id = a1.member_id WHERE a1.project_id = +'$pid'";
            if (mysqli_query($conn, $sql)) {echo "Project $pid Members Deleted";} else {echo mysqli_error($conn);}

            $sql = "DELETE FROM projects WHERE id='$pid'";
            if (mysqli_query($conn, $sql)) {echo "Project $pid Deleted";} else {echo mysqli_error($conn);}

            $sql = "DELETE FROM assist WHERE project_id='$pid'";
            if (mysqli_query($conn, $sql)) {echo "Project $pid Assists Deleted";} else {echo mysqli_error($conn);}

            $sql = "DELETE FROM sprints WHERE project_id='$pid'";
            if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

            $sql = "DELETE FROM sprint_member WHERE project_id='$pid'";
            if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

            $sql = "DELETE FROM stories WHERE project_id='$pid'";
            if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

            $sql = "DELETE FROM tasks WHERE project_id='$pid'";
            if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

            $sql = "DELETE FROM estimations WHERE project_id='$pid'";
            if (mysqli_query($conn, $sql)){echo '1';}else{echo mysqli_error($conn);}

}

mysqli_close($conn);




?>