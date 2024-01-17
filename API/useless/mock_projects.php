<?php
require 'config.php';

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);


$sql = "SELECT * FROM mock_projects ";

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