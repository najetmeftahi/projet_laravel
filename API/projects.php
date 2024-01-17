<?php
require "config.php";

$conn = mysqli_connect($dbs, $dbu, $dbp, $dbn);
if (isset($_GET["maxinc"])) {
    $sql = "SELECT `AUTO_INCREMENT`
    FROM  INFORMATION_SCHEMA.TABLES
    WHERE TABLE_SCHEMA = '$dbn'
    AND   TABLE_NAME   = 'projects';";
    $result = mysqli_query($conn, $sql);
    $r = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
        //print_r($r);
        if ($r[0]["AUTO_INCREMENT"] == "") {
            print 0;
        } else {
            print $r[0]["AUTO_INCREMENT"];
        }
    } else {
        echo "0 results";
    }
    die();
}else{}

if (isset($_GET["maxid"])) {
    $sql = "SELECT MAX(id) FROM projects";
    $result = mysqli_query($conn, $sql);
    $r = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
        if ($r[0]["MAX(id)"] == "") {
            print 0;
        } else {
            print $r[0]["MAX(id)"];
        }
    } else {
        echo "0 results";
    }
} elseif (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    $sql = "SELECT * FROM projects WHERE id = '$pid'";
    $result = mysqli_query($conn, $sql);
    $r = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
        $json = json_encode($r);
        print $json;
    } else {
        echo "0 results";
    }
} else {
    //MEMBER COUNT UPDATE
    $sql = "UPDATE projects SET member_count = (SELECT COUNT(project_id) FROM assist WHERE assist.project_id = projects.id)";
    $result = mysqli_query($conn, $sql);


    $sql = "SELECT * FROM projects";
    $result = mysqli_query($conn, $sql);
    $r = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
        $json = json_encode($r);
        print $json;
    } else {
        echo "0 results";
    }
}

mysqli_close($conn);

?>
