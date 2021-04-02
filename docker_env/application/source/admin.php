<?php
session_start();
// checking user logged or not
if (empty($_SESSION['user'])) {
    header('location: index.php');
}
// restrict user to access admin.php page
if ($_SESSION['user']['role'] == 'user') {
    header('location: user.php');
} else {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css" type="text/css" />
</head>
<body>
    <header>  
    <nav class="navbar">
    <div class="logo">
            <img src="logo.png" width = "110" height = "110" id="theater"/>
        </div> 
         <a button href="">Accounts</a>
         <a href="">Comments</a>
       
        </nav>   
    </header>
   
  

    <h1>Welcome to the <?php echo $_SESSION['user']['username']; ?> Page</h1>
     
    <div id="profile">
        <h2>Your Username is: <?php echo  "<u>". $_SESSION['user']['username']."</u>"; ?> and Your Role is :<?php echo "<u>". $_SESSION['user']['role']."</u>"; ?></h2>
        <div id="logout"><a href="logout.php">Please Click To Logout</a></div>
    </div>
 
    <table id="table">
    <tr>
        <th>Id</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>username</th>
        <th>email</th>
        <th>role</th>
        <th>operation</th>
    </tr>
       




<?php

//connect to database
$conn = mysqli_connect("database", "root", "root", "GetFlix");


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//select en insert database data into html 
$sql = "SELECT id, firstname, lastname, username, email, role FROM user ORDER BY id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row["id"]. "</td>";
echo"<td>" . $row["firstname"] . "</td>";
echo"<td>". $row["lastname"]."</td>";
echo"<td>". $row["username"]."</td>";
echo"<td>". $row["email"]."</td>";
echo"<td>". $row["role"]."</td>";
//delete a row from the database 
echo"<td><a href = delete.php?id=".$row['id'].">delete</a></td>";
echo"</tr>";
}
}

?>
</table>
<footer>
  <hr>
</footer>
  
<?php } ?>
    
</body>
</html>