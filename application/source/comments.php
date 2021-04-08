

<?php
require 'function.php';
logged_only();
?>

<?php
require('header.php');
?>



    <h1>Welcome to the backend Comments Page</h1>
     
    <div id="profile">
        <h2>Your Username is: <?php echo  "<u>". $_SESSION['user']['username']."</u>"; ?> and Your Role is :<?php echo "<u>". $_SESSION['user']['role']."</u>"; ?></h2>
        <div id="logout"><a href="logout.php">Please Click To Logout</a></div>
    </div>
 
    <table id="table">
    <tr>
        <th>Id</th>
        <th>User</th>
        <th>Date</th>
        <th>Comment</th>

       
      
    </tr>
    
<?php
//connect to database
$conn = mysqli_connect("database", "root", "root", "GetFlix");


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//select en insert database data into html 
$sql = "SELECT id, uid, date, message FROM comments ORDER BY id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row["id"]. "</td>";
echo"<td>" . $row["uid"] . "</td>";
echo"<td>" . $row["date"] . "</td>";
echo"<td>" . $row["message"] . "</td>";

//delete a row from the database 
echo"<td><a href = delete2.php?id=".$row['id'].">delete</a></td>";
echo"</tr>";
}
}
?>
</table>
<?php

require('footer.php');
?>
