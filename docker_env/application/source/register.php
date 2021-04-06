<?php


require('config.php');

if (isset($_POST['forminscription'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    if (!empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['username']) and !empty($_POST['email']) and !empty($_POST['email2']) and !empty($_POST['password']) and !empty($_POST['password2'])) {
        $firstnamelength = strlen($firstname);
        $lastnamelength = strlen($lastname);
        $usernamelength = strlen($username);
        if ($firstnamelength <= 255 and $lastnamelength <= 255 and $usernamelength <= 255) {
            if ($email == $email2) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $dbh->prepare("SELECT * FROM user WHERE email = ?");
                    $reqmail->execute(array($email));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        if ($password == $password2) {
                            $insertmbr = $dbh->prepare("INSERT INTO user(firstname, lastname, username, email, password) VALUES(?, ?, ?, ?, ?)");
                            $insertmbr->execute(array($firstname, $lastname, $username, $email, $password));
                            $erreur = "Your Account is Created! <a href=\"login.php\">Log in</a>";
                        } else {
                            $erreur = "Your passwords do not match !";
                        }
                    } else {
                        $erreur = "Email address already exists!";
                    }
                } else {
                    $erreur = "Your Email address is not valid!";
                }
            } else {
                $erreur = "Your Email address doesn't correspond !";
            }
        } else {
            $erreur = "Your username is too long !";
        }
    } else {
        $erreur = "Please fill in All the blanks!";
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
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css"/>
    <script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
    <title>The theater</title>
</head>

<body>

<nav class="navbar navbar-dark bg-dark d-flex justify-content-around">
    <!-- Navbar content -->
    <div><img id="logo" src="./pictures/Logo.png" alt="logo" srcset=""></div>
    <a href="index.php" style="color: white;">Welcome Page</a>
    <a href="register.php" class="active">Register</a>
    <a href="login.php" style="color: white;">Log in</a>
</nav>

<div class="container-fluid">


        <h2 class="section-heading h1 pt-4 text-white text-center">Registration</h2>

        <div class="row d-flex justify-content-center">

            <div class="col-sm-8">

                <div class="card">
                    <form method="POST" action="" class="card-body">
                        <div class="form-header">
                            <h3><i class="fas fa-envelope-square"></i> Please Fill in All the Blanks</h3>
                        </div>

                        <div class="md-form">
                            <i class="fas fa-user prefix grey-text"></i>

                            <label for="form-firstname">First Name</label>

                            <input type="text" name="firstname" id="firstname" class="form-control"
                                   value="<?php if (isset($firstname)) {
                                       echo $firstname;
                                   } ?>"/>

                        </div>

                        <div class="md-form">
                            <i class="fas fa-user prefix grey-text"></i>

                            <label for="form-lastname">Last Name</label>

                            <input type="text" id="lastname" class="form-control" name="lastname"
                                   value="<?php if (isset($lastname)) {
                                       echo $lastname;
                                   } ?>"/>

                        </div>

                        <div class="md-form">
                            <i class="fas fa-user prefix grey-text"></i>

                            <label for="form-nickname">Nickname</label>

                            <input type="text" id="username" class="form-control" name="username"
                                   value="<?php if (isset($username)) {
                                       echo $username;
                                   } ?>"/>

                        </div>

                        <div class="md-form">
                            <i class="fas fa-envelope prefix grey-text"></i>

                            <label for="form-email">Your email</label>

                            <input type="text" class="form-control" id="email" name="email"
                                   value="<?php if (isset($email)) {
                                       echo $email;
                                   } ?>"/>


                        </div>

                        <div class="md-form">
                            <i class="fas fa-envelope prefix grey-text"></i>

                            <label for="form-email" style="width: max-content"">Comfirm your email</label>

                            <input type="text" class="form-control" id="email2" name="email2"
                                   value="<?php if (isset($email2)) {
                                       echo $email2;
                                   } ?>"/>

                        </div>

                        <div class="md-form">
                            <i class="fas fa-key"></i>
                            <label for="form-password">Password</label>
                            <input type="text" class="form-control" id="password" name="password"/>

                        </div>




                        <input type="hidden" name="forminscription" value="any"/>

                        <div class="md-form">
                            <i class="fas fa-key"></i>
                            <label for="for-confirm" style="width: max-content">Confirm Password</label>
                            <input type="text" class="form-control" id="password2" name="password2"/>




                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-light-blue" name="forminscription">Submit</button>
                            <i class="fas fa-paper-plane"></i>
                        </div>

                        <div class="text-center mt-4" style="color: #e74c3c">
                            <?php
                            if (isset($erreur)) {
                                echo $erreur;
                            }
                            ?>
                        </div>
                    </form>

                </div>


            </div>



</div>


</body>

</html>