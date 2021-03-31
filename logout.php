<?php
session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60 * 60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
unset($_SESSION['login']);
session_destroy();
header("location: index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    
    <script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style2.css">
</head>
<body>



<header class="bg-light m-1 p-1">
      

      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
              <div class="d-flex justify-content-start offset-2 ">
                 <img src="./bunny eating.jpg" class="rounded-pill" width="120px" alt="bunny eating"></a>
                  </div>
          <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarMenu">
              <div class="navbar-nav">
                  <a class="nav-item nav-link m-auto" href="guestbook.php">BackGuestbook</a>
                  <a class="nav-item nav-link m-auto" href="BackGallery.php">BackGallery</a>
                  <a class="nav-item nav-link m-auto active" aria-current="page" href="Backmessage.php">Backmessages</a>
              </div>
          </div>
      </nav>
</header>
 

<table id="table">
    <tr>
        <th>Id</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>email</th>
        <th>messages</th>
        <th>operation</th>
       




<?php
if (isset($_POST['pass']) AND $_POST['pass'] ===  "SpaceJam"){
//config


$conn = mysqli_connect("localhost", "root", "", "contact");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, firstname, lastname, email, message FROM visiteurs ORDER BY id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row["id"]. "</td>";
echo"<td>" . $row["firstname"] . "</td>";
echo"<td>". $row["lastname"]."</td>";
echo"<td>". $row["email"]."</td>";
echo"<td>". $row["message"]."</td>";
echo"<td><a href = delete.php?id=".$row['id'].">delete</a></td>";
echo"</tr>";
}
}
}
else 
{
    header("Location: contact.php");
}

?>
</table>
</body>
</html>