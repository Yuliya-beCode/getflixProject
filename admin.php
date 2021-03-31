<?php
session_start();
// checking user logged or not
if (empty($_SESSION['user'])) {
    header('location: index.php');
}
// restrict user to access admin.php page
if ($_SESSION['user']['role']=='user') {
    header('location: user.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
 
<h1>Welcome to <?php echo $_SESSION['user']['username'];?> Page</h1>
<h2> testing </h2>

<link rel="stylesheet" href="style.css" type="text/css"/>
<div id="profile">
    <h2>username is: <?php echo $_SESSION['user']['username'];?> and Your Role is :<?php echo $_SESSION['user']['role'];?></h2>
<div id="logout"><a href="logout.php">Please Click To Logout</a></div>
</div>
<?php } ?>
   
</body>
</html>