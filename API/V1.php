<?php
/*IWSQL SIMILAR TO GRAPHQL*/
require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

$ALL[] = array();

if(isset($_POST['projects'])){
    $sql = "SELECT * FROM projects";
    $result = mysqli_query($conn, $sql);
    $pjr = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pjr[] = $row;
        }
    }
    $ALL['projects'] = $pjr;

}

if(isset($_POST['sprints'])){
    $sql = "SELECT * FROM sprints";
    $result = mysqli_query($conn, $sql);
    $pjr = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pjr[] = $row;
        }
    }
    $ALL['sprints'] = $pjr;
}




print(json_encode($ALL));


mysqli_close($conn);
?>