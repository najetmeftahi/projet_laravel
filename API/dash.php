<?php


require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
function DB($conn,$sql){
    $result = mysqli_query($conn, $sql); $r = array();
    if (mysqli_num_rows($result) > 0) {while ($row = mysqli_fetch_assoc($result)) {$r[]= $row;}}
    return $r;
}
function nulltozero($x){
    if(is_null($x)){
        return 0;
    }
    return intval($x);
}



if(isset($_POST['membersstat'])){
    $pid = $_POST['membersstat'];

    $ProjectTotalDurationInDays = 0;
    foreach (DB($conn,"SELECT sdate , edate FROM `sprints` WHERE project_id = '$pid'") as $k => $sprint) {
        $ProjectTotalDurationInDays += intval(GetWorkingDays($sprint['sdate'],$sprint['edate']));
    }

    $v = array('project_dur'=>$ProjectTotalDurationInDays*$hpd,'members'=>array());
    foreach (DB($conn,"SELECT id,firstname,lastname,mrole,project_id FROM members LEFT JOIN assist ON members.id = assist.member_id WHERE assist.project_id = '$pid'") as $k => $member) {
        $uid = $member['id'];

        $fullname = $member['firstname'].' '.$member['lastname'];
        
        $v['members'][$uid]['fullname'] = $fullname;

        $onp =  (DB($conn,"SELECT SUM(real_dur) AS onp FROM `tasks` WHERE project_id = '$pid' AND assignee_id = '$uid'"));

        $v['members'][$uid]['tasks']['on'] = nulltozero($onp[0]['onp']);

        $ofp =  (DB($conn,"SELECT SUM(duration) AS ofp FROM `off_tasks` WHERE project_id = '$pid' AND assignee_id = '$uid'"));

        $v['members'][$uid]['tasks']['off'] = nulltozero($ofp[0]['ofp']);

        $v['members'][$uid]['tasks']['av'] = intval(($ProjectTotalDurationInDays*$hpd) - (nulltozero($ofp[0]['ofp']) + nulltozero($onp[0]['onp'])));
        



    }
    print(json_encode($v));
}







if(isset($_POST['velocity'])){
    $pid = $_POST['velocity'];
    $v = array();
    foreach (DB($conn,"SELECT * FROM sprints WHERE project_id = '$pid'") as $k => $sprint) {
        $sid = $sprint['id'];
        $v[$sid]['title'] = $sprint['title'];
        $req = DB($conn,"SELECT * FROM stories WHERE project_id = '$pid' AND sprint_id = '$sid'");
        foreach ($req as $k => $story) {
            $v[$sid]['stories'] = 0;
            $v[$sid]['stories'] = count($req);
        }
    }
    print(json_encode($v));
}



$all = array();
if(isset($_POST['projectlist'])){
    $sql = "SELECT id , title FROM projects ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $r = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $r[] = $row;
        }
        $json = json_encode($r);
        print $json;
    }
}
if(isset($_POST['sum'])){
$sql="  SELECT COUNT(id) FROM projects
        UNION ALL
        SELECT COUNT(id) FROM projects WHERE pstatus = 1
        UNION ALL
        SELECT COUNT(id) FROM projects WHERE pstatus = 2
        UNION ALL
        SELECT COUNT(id) FROM projects WHERE pstatus = 3 
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
print(json_encode($all));
}

if(isset($_POST['kpiData'])){

if(null != ($_POST['kpiData'])){
    $kpiData = array();
    $pid = $_POST['kpiData'];
    

    $ProjectTotalDurationInDays = 0;
    foreach (DB($conn,"SELECT sdate , edate FROM `sprints` WHERE project_id = '$pid'") as $k => $sprint) {
        $ProjectTotalDurationInDays += intval(GetWorkingDays($sprint['sdate'],$sprint['edate']));
    }

    $onprojecttaskdur =  (DB($conn,"SELECT SUM(real_dur) AS taskDur FROM `tasks` WHERE project_id = '$pid' 
                            UNION ALL 
                            SELECT SUM(real_dur) FROM `tasks` WHERE project_id = '$pid' AND tskstatus = 3
                            UNION ALL
                            SELECT SUM(real_dur) FROM `tasks` WHERE project_id = '$pid' AND tskstatus = 2
                            UNION ALL
                            SELECT SUM(real_dur) FROM `tasks` WHERE project_id = '$pid' AND tskstatus = 1
    "));

    $offprojecttaskdur =  (DB($conn,"SELECT SUM(duration) AS taskDur FROM `off_tasks` WHERE project_id = '$pid' 
                                UNION ALL 
                                SELECT SUM(duration) FROM `off_tasks` WHERE project_id = '$pid' AND tskstatus = 3
                                UNION ALL
                                SELECT SUM(duration) FROM `off_tasks` WHERE project_id = '$pid' AND tskstatus = 1
    "));


    $kpiData = array(
        'ProjectKPI' => number_format(($offprojecttaskdur[0]['taskDur']+$onprojecttaskdur[0]['taskDur'])/($ProjectTotalDurationInDays*$hpd),2),
        'ProjectTotalDays' => $ProjectTotalDurationInDays,
        'ProjectTotalHours' => intval($ProjectTotalDurationInDays*$hpd),
        'ProjectRealDuration' => $onprojecttaskdur[0]['taskDur'],
    );
    print(json_encode($kpiData));
}else{die('[]');}

}

mysqli_close($conn);
?>