<?php
require 'config.php';
/*SELECT * FROM sprints WHERE project_id = 1*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
if(isset($_GET['pid'])){

    /*add project id validation */
    $pid = $_GET['pid'];

    if(isset($_GET['sid'])){
        $sid = $_GET['sid'];
        /*SELECT * FROM `sprints` WHERE project_id = 2 AND id = 12*/
        $sql = "SELECT * FROM sprints WHERE project_id = '$pid' AND id = '$sid'";
        
    }else{
        $sql = "SELECT * FROM sprints WHERE project_id = '$pid'";
    }


    $result = mysqli_query($conn, $sql);
$r = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $r[] = $row;
    }
    $json = json_encode($r);
    print($json);
} else {
    //error if empty
    echo "";
}
mysqli_close($conn);

}


?>