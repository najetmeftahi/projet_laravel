<?php
require 'config.php';
/*Store MEMBERS*/

$conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);

function idexists($uid){
    GLOBAL $conn;
    $sql = "SELECT id FROM members WHERE id='$uid'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

/*unique id generator*/
$memberid = rand(1000000,9999999);
while(idexists($memberid)){
    $memberid = rand(1000000,9999999);
}

if(isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['pid'])){
if(1){
            $fname = $_GET['fname'];
            $lname = $_GET['lname'];
            $role = $_GET['mrole'];
            $pid = $_GET['pid'];
            $sql = "INSERT INTO members (id,firstname,lastname) VALUES ('$memberid','$fname','$lname')";
            if (mysqli_query($conn, $sql)) {echo "New member added";} else {echo "Error:".mysqli_error($conn);}
            
            $sql = "INSERT INTO assist (member_id,project_id,mrole) VALUES ('$memberid','$pid','$role')";
            if (mysqli_query($conn, $sql)) {echo "New project member added";} else {echo "Error:".mysqli_error($conn);}
}else{
    die('bad request 1');
}
}else{
    die('bad request 0');
}

mysqli_close($conn);




?>