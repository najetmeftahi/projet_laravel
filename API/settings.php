<?php





require 'config.php';
$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
function DB($conn,$sql){
    $result = mysqli_query($conn, $sql); $r = array();
    if (mysqli_num_rows($result) > 0) {while ($row = mysqli_fetch_assoc($result)) {$r[]= $row;}}
    return $r;
}



if(isset($_POST['loadusers'])){
    $r = DB($conn,'SELECT * FROM admins');
    print_r(json_encode($r));
}


if(isset($_POST['adduser'])){

    $un =  'user'.substr(str_shuffle('0123456789abcdefghijklmopstuvwy'),0,4);
    $pass = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,8);

    while(sizeof(DB($conn,"SELECT * FROM `admins` WHERE user = '$un'"))>0){
        $un =  'user_'.substr(str_shuffle('0123456789abcdefghijklmopstuvwy'),0,4);
        $pass = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,8);
    }
    print('user added');
    error_reporting( 0 );
    DB($conn,"INSERT INTO `admins` (`id`, `user`, `pass`, `isroot`) VALUES (NULL, '$un', '$pass', '0')");

}

if(isset($_POST['deleteuser'])){

    if(!empty($_POST['deleteuser'])){
        $uid = intval($_POST['deleteuser']);
        print('user deleted');
        error_reporting( 0 );
        DB($conn,"DELETE FROM `admins` WHERE `admins`.`id` = '$uid'");
    }

}


if(isset($_POST['updateuser'])){

    if(!empty($_POST['updateuser'])){
        $uid = $_POST['updateuser'];
        $for = $_POST['for'];
        $newval = $_POST['newval'];
        
        DB($conn,"UPDATE `admins` SET `$for` = '$newval' WHERE id = '$uid'");

    }

}

if(isset($_POST['listbackups'])){

    $backups = array_diff(scandir(__DIR__.'/backups'),array('.','..'));
    print(json_encode($backups));
}



mysqli_close($conn);
?>