<?php
$Host = 'localhost';
$UserName = 'root';
$Password = 'root';
$dbn = 'GetFlix';

//phpinfo();

try {
    $dbh = new PDO("mysql:host=$Host;dbname=$dbn", $UserName, $Password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>

