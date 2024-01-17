<?php
require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
/*
LIST TASKS WITH MEMBERS
SELECT members.firstname,members.lastname,members.id
FROM members
LEFT JOIN tasks ON members.id = tasks.assignee_id
WHERE tasks.id = 1
// all info
SELECT * FROM members LEFT JOIN tasks ON members.id = tasks.assignee_id WHERE tasks.id = 1;
// only assignee
SELECT members.firstname,members.lastname FROM members LEFT JOIN tasks ON members.id = tasks.assignee_id WHERE tasks.id = 1;
*/
if(isset($_GET['tid'])){
/*add project id & sprint id validation */
$tid = $_GET['tid'];


$sql = "SELECT * FROM members LEFT JOIN tasks ON members.id = tasks.assignee_id WHERE tasks.id = '$tid'";
$result = mysqli_query($conn, $sql);
$r = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $r[] = $row;
    }
    $json = json_encode($r);
    print($json);
} else {
    echo "[]";
}
mysqli_close($conn);

}


?>