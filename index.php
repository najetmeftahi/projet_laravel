<?php
require 'config.php';
try {
    $conn = mysqli_connect($dbs,$dbu,$dbp,$dbn);
} catch (\Throwable $th) {
        die("Database Error");
    
}

if(isset($_COOKIE['auth'])){
    header('Location: dashboard.php');
exit;
}else{

/*login config*/
/*validation token*/
$key = 'dGVtcG9fdG9rZW4=';
if(isset($_SERVER['REQUEST_METHOD'])){
if(($_SERVER['REQUEST_METHOD']) == 'POST'){
    if(isset($_POST['id']) && isset($_POST['pass'])){
            $id = filter_var($_POST['id'],FILTER_SANITIZE_STRING);
            $pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);

            $sql = "SELECT user,pass FROM admins WHERE user = '$id'";
            $result = mysqli_query($conn, $sql);
            $r = array();
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                $r[] = $row;
                }
                $conf_id = $r[0]['user'];
                $conf_pass = $r[0]['pass'];
            }else{
                $conf_id ="NoDBID";
                $conf_pass ="NoDBPASS";
            }
            if(( $conf_pass == $pass )&&( $conf_id == $id ) ){
                /*Valid credentials*/
                /*Setting up a cookie*/ 
                setcookie('auth',base64_encode($conf_id), time() + (86400 * 7), "/");
                if(isset($_COOKIE['auth'])){
                    die('logged_in');
                }
            }else{
                /*Wrong credentials*/
                die('Wrong login');
            }
    }else{
        die('Post Data is not Set');
    }
}


}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScrumApp - Login</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    

</head>
<body>

<div class="app vh-100 d-flex justify-content-center align-items-center">

    <div class="mid row vh-100 d-flex justify-content-center align-items-center col-3">
        <div class="align-self-start col-12">
            <!--Start / Header-->
        </div>

        <div class="row align-self-center col-12">
            <div class="f-head align-content-center justify-content-center text-center pb-4">
            <img src="bootstrap/logo.png" alt="logo" style="height:80px;">
                <h3 class="loginlbl text-muted">ScrumApp</h3>
            </div>

            <div class="f-id row d-flex align-content-center justify-content-center">
                <div class="col-10 pb-4">
                    <label for="userid" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="userid" autocomplete="off">
                </div>

                <div class="col-10 pb-4">
                    <label for="userpass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="userpass" autocomplete="off">
                </div>

                <div class="col-12 d-flex justify-content-center pb-4">
                    <button type="submit" class="col-8 btn btn-iws-green" id="loginbtn">Submit</button>
                </div>
                
            </div>


        </div>

        <div class=" align-self-end col-12">
            <!--End / Footer-->
        </div>
    </div>

</div>

<script type="text/javascript" src="js/script.js"></script>
</body>
</html>