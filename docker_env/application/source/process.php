<?php
ob_start();

$mysqli = new mysqli('database','root','root','GetFlix') or die(mysqli_error($mysqli));
$message='';
$update= false;
$id = 0;

if (isset($_POST['save'])){

    $date = $_POST['date'];
    $message =  $_POST['message'];
   
    $mysqli->query("INSERT INTO comments (message) VALUES ('$message')");
        header("Location:info.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM comments WHERE id=$id") ;
    header("Location:info.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM comments WHERE id=$id") ;
    if (count($result) ==1){
        $row = $result->fetch_array();
        $date = $row['date'];
        $message = $row ['message'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $message =$_POST['message'];
    $mysqli->query("UPDATE comments SET message='$message' WHERE id=$id") ;
    header("Location:info.php");
}
ob_end_clean();