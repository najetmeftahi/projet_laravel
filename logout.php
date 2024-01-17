<?php
if (isset($_COOKIE['auth'])) {
    unset($_COOKIE['auth']); 
    setcookie('auth', null, -1, '/');
    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}

?>