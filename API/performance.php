<?php
/*IWSQL*/
require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);


if(isset($_POST['pid'])){
    $all = array('sprints'=>array());
    $pid  = $_POST['pid'];

$sql="SELECT id,title FROM sprints WHERE project_id = '$pid'";
$result = mysqli_query($conn, $sql);
$t = array();
if (mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_assoc($result)) {
$t[] = $row;
}
}
foreach ($t as $key => $sprint) {
    $all['sprints'][$sprint['title']] = [];
    $spid  = $sprint['id'];
    $sql="SELECT id,title FROM stories WHERE sprint_id = '$spid'";
    $result = mysqli_query($conn, $sql);
    $st = array();
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    $st[] = $row;
    }
    }
    foreach ($st as $key => $story) {
        $all['sprints'][$sprint['title']][$story['title']] = [];
        $stid  = $story['id'];
        $sql="SELECT * FROM tasks WHERE story_id = '$stid'";
        $result = mysqli_query($conn, $sql);
        $tk = array();
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
        $tk[] = $row;
        }
        }
        foreach ($tk as $key => $task) {
            $all['sprints'][$sprint['title']][$story['title']][$task['title']]['status'] = $task['tskstatus'];
        }
    }
}
print(json_encode($all));
}






mysqli_close($conn);





/*
if(isset($_POST['velocity'])){
            $all = array();
            $pid  = $_POST['velocity'];

        $sql="  SELECT COUNT(id) FROM stories WHERE project_id = '$pid'
        UNION ALL
        SELECT COUNT(id) FROM stories WHERE project_id = '$pid' AND ststatus = 1
        UNION ALL
        SELECT COUNT(id) FROM stories WHERE project_id = '$pid' AND ststatus = 2
        UNION ALL
        SELECT COUNT(id) FROM stories WHERE project_id = '$pid' AND ststatus = 3 
        ";
        $result = mysqli_query($conn, $sql);
        $tsk = array();
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
        $tsk[] = $row;
        }
        }
        $all['tot'] = $tsk[0]['COUNT(id)'];
        $all['not'] = $tsk[1]['COUNT(id)'];
        $all['ont'] = $tsk[2]['COUNT(id)'];
        $all['don'] = $tsk[3]['COUNT(id)'];

        print_r($all);

}*/



?>