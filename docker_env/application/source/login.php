<?php
session_start();
include('config.php');
//Getting Input value
if (!empty($_SESSION['user'])) {
    header("user.php");
} else {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $role = $_POST['role'];

        if (empty($username) && empty($password)) {
            $error = 'Fields are mandatory';
        } else {
            //Checking login detail
            $sql = "SELECT * FROM `user` WHERE `username`=:username AND `password`=:password AND `role`=:role";
            $query = $dbh->prepare($sql);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':role', $role, PDO::PARAM_STR);
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
                        header('location: user.php');
                        break;
                    case 'admin':
                        header('location: admin.php');
                        break;
                }
            } else {
                $error = "Login et/ou mot de passe incorrect ! <a href=\"register.php\">S'enregistrer</a>";
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
              crossorigin="anonymous">

        <link rel="stylesheet" href="style.css"/>
        <script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
        <title>The theater</title>
    </head>

    <body>

    <nav class="navbar navbar-dark bg-dark d-flex justify-content-around">
        <!-- Navbar content -->
        <div><img id="logo" src="./pictures/Logo.png" alt="logo" srcset=""></div>
        <a button href="index.php" style="color: white;">Welcome Page</a>
        <a href="register.php" style="color: white;">Register</a>
        <a href="login.php" class="active">Log in</a>
    </nav>

    <div class="container-fluid">

            <h2 class="section-heading h1 pt-4 text-white text-center">Log in</h2>

            <div class="row d-flex justify-content-center">


                <div class="col-sm-8 ">


                    <div class="card">

                        <form method="POST" action="" class="card-body">
                            <div class="form-header">
                                <h3><i class="fas fa-envelope-square"></i> Please Fill in All the Blanks</h3>
                            </div>

                            <div class="md-form">
                                <i class="fas fa-user prefix grey-text"></i>
                                <label for="Username">Username</label>

                                <input type="text" class="form-control" name="username"/>
                            </div>

                            <div class="md-form">
                                <i class="fas fa-key"></i>
                                <label for="Password">Password</label>

                                <input type="password" class="form-control" name="password"/>
                            </div>


                            <div class="md-form">
                                <div class="mb-1">
                                    <label class="form-label" style="width: max-content">Select User Type:</label>

                                <select class="form-select mb-3"
                                        name="role"
                                        aria-label="Default select example">
                                    <option selected value="guest">Guest</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button class="btn btn-light-blue" name="login" value="Login">Log in</button>
                                <i class="fas fa-paper-plane"></i>
                            </div>

                            <div class="text-center mt-4" style="color: #e74c3c">
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
    </html>
<?php } ?>