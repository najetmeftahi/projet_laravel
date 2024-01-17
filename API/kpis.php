<?php
require 'config.php';
function DB($conn,$sql){
            $result = mysqli_query($conn, $sql); $r = array();
            if (mysqli_num_rows($result) > 0) {while ($row = mysqli_fetch_assoc($result)) {$r[]= $row;}}
            return $r;
}




$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

function GetProjectReport($pid,$conn,$hpd){
    $report = array(
        'Sprints'=>array('real_duration'=>0),
        'Members'=>array(array('fullname'=>'John Doe')),
        );
    if(isset($_POST['kpi'])){
        $pid = $_POST['kpi'];
        $sql = "SELECT id,sdate,edate FROM sprints WHERE project_id = '$pid' ORDER BY `sprints`.`id` ASC";
        $result = mysqli_query($conn, $sql);
        $r = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $r[]= $row;
            }
            $sprints = array();
            foreach ($r as $k => $sprint) {
                $sid = $sprint['id'];


                $sql = "SELECT id,firstname, lastname FROM members LEFT JOIN sprint_member ON members.id = sprint_member.member_id WHERE sprint_member.project_id = '$pid' AND sprint_member.sprint_id = '$sid'";
                $result = mysqli_query($conn, $sql); $r = array();
                if (mysqli_num_rows($result) > 0) {while ($row = mysqli_fetch_assoc($result)) {$r[]= $row;}
                        foreach($r as $k => $member){
                            $uid = $member['id'];
                            $sprint_members[$member['id']]['fullname'] = $member['firstname'].' '.$member['lastname'];
                            $sprint_members[$member['id']]['tasks'] = array();
                            $sprint_members[$member['id']]['off_tasks'] = array();

                            $user_tasks = array();
                            foreach (DB($conn,"SELECT * FROM tasks WHERE project_id = '$pid' AND sprint_id = '$sid' AND assignee_id = '$uid'") as $key => $task) {
                                $user_tasks[$task['id']] = array('title' => $task['title'] , 
                                                                'status' => $task['tskstatus'],
                                                                'real_dur' => $task['real_dur'],
                                                                'est_dur' => $task['est_dur']
                                                                );
                            }
                            $sprint_members[$member['id']]['tasks'] = $user_tasks;

                            $user_offtasks = array();
                            foreach (DB($conn,"SELECT * FROM off_tasks WHERE project_id = '$pid' AND sprint_id = '$sid' AND assignee_id = '$uid'") as $key => $task) {
                                $user_offtasks[$task['id']] = array('title' => $task['title'] , 
                                                                'status' => $task['tskstatus'],
                                                                'duration' => $task['duration']
                                                                );
                            }
                            $sprint_members[$member['id']]['off_tasks'] = $user_offtasks;

                }


                
                $sprints[] = array(
                    'id' => $sid,
                    'sdate' => $sprint['sdate'],
                    'edate' => $sprint['edate'],
                    'wdays' => GetWorkingDays($sprint['sdate'],$sprint['edate']),
                    'whours' => intval(GetWorkingDays($sprint['sdate'],$sprint['edate'])) * $hpd,
                    'members' =>$sprint_members
                );

            }

        }
        //$json = json_encode($sprints);
        //print $json;
        return $sprints;
    }

    }
}

print(json_encode(GetProjectReport(NULL,$conn,$hpd)));









mysqli_close($conn);
?>