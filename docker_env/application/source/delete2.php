<?php 


$conn = mysqli_connect("database", "root", "root", "GetFlix");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}



$sql = "DELETE FROM comments WHERE ID='$_GET[id]'";
//$result = $conn->query($sql);

if (mysqli_query($conn,$sql))
{
header("refresh:1; url=comments.php");
}
else
{
echo "not deleted";
}

?>