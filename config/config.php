<?php

if(!file_exists(__DIR__.'/./config.json')){
    die('CONFIG FILE ERROR');
}

$configFile = json_decode(file_get_contents(__DIR__.'/./config.json'),true);

$dbs = $configFile['db_server'];
$dbu = $configFile['db_user'];
$dbp = $configFile['db_pass'];
$dbn = $configFile['db_name'];


$hpd = $configFile['HoursPerDay'];


function GetWorkingDays($from, $to) {
    global $configFile;
    $wDays = $configFile['WorkingDays'];
    $hDays = array_unique($configFile['holidays']);
    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);
    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $wDays)) continue;
        if (in_array($period->format('Y-m-d'), $hDays)) continue;
        if (in_array($period->format('*-m-d'), $hDays)) continue;
        $days++;
    }
    return $days;
}




?>