<?php 
require 'config.php';
include ('dumper.php');

try {
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => $dbs,
		'username' => $dbu,
		'password' => $dbp,
		'db_name' => $dbn,
	));

    $Backupfile = $dbn.'_'.time().'.sql';

	$world_dumper->dump('backups/'.$Backupfile);

    if(file_exists(__DIR__.'/backups/'.$Backupfile)){
        die($Backupfile);
    }else{
        die('error');
    }


} catch(Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}