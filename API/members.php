<?php
require 'config.php';
/*LIST MEMBERS*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

if(isset($_GET['p_id'])){
    /*add project id validation */
    $pid = $_GET['p_id'];
    //$sql = "SELECT * FROM members WHERE project_id= $pid";
    $sql = "SELECT member_id FROM member_project WHERE project_id = '$pid'";
}else{
    $sql = "SELECT * FROM members";
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
    echo "0 results";
}
mysqli_close($conn);




?>