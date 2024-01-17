<?php

$configFile = __DIR__.'/../config/config.json';

$configArray = json_decode(file_get_contents($configFile),true);

/*
$file = fopen($configFile, "w") or die("$configFile error");
file_put_contents($configFile,json_encode($configArray));
*/

if(isset($_POST['dbstatus'])){
    $dbs = $configArray['db_server'];
    $dbu = $configArray['db_user'];
    $dbp = $configArray['db_pass'];
    $dbn = $configArray['db_name'];
    if(mysqli_connect($dbs,$dbu,$dbp,$dbn)){
        die('1');
    }else{
        die('0');
    }
}
if(isset($_POST['dbdetails'])){
    $dbs = $configArray['db_server'];
    $dbu = $configArray['db_user'];
    $dbp = $configArray['db_pass'];
    $dbn = $configArray['db_name'];
    die(json_encode(array('server'=>$dbs,'user'=>$dbu,'pass'=>$dbp,'name'=>$dbn)));
}


if(isset($_POST['calendardetails'])){

    die(json_encode(array(
        'hpd'=>$configArray['HoursPerDay'],
        'workingdays'=>$configArray['WorkingDays'],
        'holidays'=>$configArray['holidays']
                            )));
}


if(isset($_POST['updatehpd'])){
    $newhpd = $_POST['updatehpd'];
    if(($newhpd <= 24) && ($newhpd >= 1)){
        $configArray = json_decode(file_get_contents($configFile),true);
        $configArray['HoursPerDay'] = intval($newhpd);
        $file = fopen($configFile, "w") or die("$configFile error");
        file_put_contents($configFile,json_encode($configArray));
    }
}


if(isset($_POST['updateDay'])){
    $day = $_POST['updateDay'];
    if($_POST['action'] == 'add'){
        $configArray = json_decode(file_get_contents($configFile),true);
        $configArray['WorkingDays'][] = intval($day);
        sort($configArray['WorkingDays']);
        $file = fopen($configFile, "w") or die("$configFile error");
        file_put_contents($configFile,json_encode($configArray));
    }else if($_POST['action'] == 'remove'){
        $configArray = json_decode(file_get_contents($configFile),true);

        if (($key = array_search(intval($day), $configArray['WorkingDays'])) !== false) {
            unset($configArray['WorkingDays'][$key]);
        }
        sort($configArray['WorkingDays']);
        $file = fopen($configFile, "w") or die("$configFile error");
        file_put_contents($configFile,json_encode($configArray));
    }
}

if(isset($_POST['updateholidays'])){
    $hday = $_POST['updateholidays'];
    if($_POST['action'] == 'add'){
        if($hday !== ''){
        $configArray = json_decode(file_get_contents($configFile),true);
        $configArray['holidays'][] = $hday;
        $configArray['holidays'] = array_unique($configArray['holidays']);
        $file = fopen($configFile, "w") or die("$configFile error");
        file_put_contents($configFile,json_encode($configArray));
    }
    }
    if($_POST['action'] == 'remove'){
        $configArray = json_decode(file_get_contents($configFile),true);
        if (($key = array_search($hday, $configArray['holidays'])) !== false) {
            unset($configArray['holidays'][$key]);
        }
        $file = fopen($configFile, "w") or die("$configFile error");
        file_put_contents($configFile,json_encode($configArray));
    }
}

?>