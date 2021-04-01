<?php
session_start();
include('config.php');
//Getting Input value
if (!empty($_SESSION['user'])) {
  header("location: user.php");
} else {
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (empty($username) && empty($password)) {
      $error = 'Fields are mandatory';
    } else {
      //Checking login detail
      $sql = "SELECT * FROM `user` WHERE `username`=:username AND `password`=:password";
      $query = $dbh->prepare($sql);
      $query->bindParam(':username', $username, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetch(PDO::FETCH_ASSOC);
      if ($query->rowCount() > 0) {
        $_SESSION['user'] = array(
          'username' => $results['username'],
          'password' => $results['password'],
          'role' => $results['role']
        );
        $role = $_SESSION['user']['role'];
        //Redirecting user based on role
        switch ($role) {
          case 'user':
            header('user.php');
            break;
          case 'admin':
            header('admin.php');
            break;
        }
      } else {
        $error = "Login and/or password are incorrect! <a href=\"register.php\">Register now/a>";
      }
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
    <title>Login</title>
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark d-flex justify-content-around">
      <!-- Navbar content -->
      <a button href="index.php" style="color: crimson;">Welcome Page</a>
      <a href="register.php" style="color: crimson;">Register</a>
      <a href="login.php" class="active">Log in</a>
    </nav>

    <div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center">
    <div class="col-sm-2">
         <img id="logo" src="./pictures/Logo.png" alt="logo" srcset="">
      </div>
          <div class="col-sm-8">


            <div class="card">

              <div class="card-body">

                <div class="form-header">
                  <h3><i class="fas fa-envelope-square"></i> Sign in</h3>
                </div>
                <br>
                <div class="md-form">
                  <label for="form-email">Username</label>
                  <i class="fas fa-user prefix grey-text"></i>
                  <input type="text" name="username" id="form-email" class="form-control">
                </div>

                <div class="md-form">
                  <label for="form-password">Password</label>
                  <i class="fas fa-key"></i>
                  <input type="password" name="password" id="form-password" class="form-control">
                </div>

                <div class="text-center mt-4">
                  <button class="btn btn-light-blue" type="submit" name="login" value="Login">Submit</button>
                  <i class="fas fa-paper-plane"></i>

                </div>

                <div class="form-footer">
                  <h5>
                    <a href="register.php" class="stretched-link">Haven't Registered yet? Click here!</a>
                  </h5>
                </div>

              </div>
              <?php if (isset($error)) {
                echo $error;
              } ?>
            </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </body>

  </html>
<?php } ?>