<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success']= 'You are disconnected';
header('Location : login.php');
?>