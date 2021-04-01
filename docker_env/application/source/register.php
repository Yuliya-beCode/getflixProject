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
                     $erreur = "Your Account is Created! <a href=\"index.php\">Log in</a>";
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

<html>

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

   <link rel="stylesheet" href="style.css" />
   <script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
   <title>The theater</title>
</head>

<body>
   <form method="POST" action="" style="display:none">
      <table>
         <tr>
            <td align="right">
               <label for="firstname">firstname :</label>
            </td>
            <td>
               <input type="text" placeholder="Votre firstname" id="firstname" name="firstname" value="<?php if (isset($firstname)) {
                                                                                                            echo $firstname;
                                                                                                         } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="lastname">lastname :</label>
            </td>
            <td>
               <input type="text" placeholder="Votre lastname" id="lastname" name="lastname" value="<?php if (isset($lastname)) {
                                                                                                         echo $lastname;
                                                                                                      } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="username">username :</label>
            </td>
            <td>
               <input type="text" placeholder="Votre username" id="username" name="username" value="<?php if (isset($username)) {
                                                                                                         echo $username;
                                                                                                      } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="email">Mail :</label>
            </td>
            <td>
               <input type="email" placeholder="Votre mail" id="email" name="email" value="<?php if (isset($email)) {
                                                                                                echo $email;
                                                                                             } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="email2">Confirmation du mail :</label>
            </td>
            <td>
               <input type="email2" placeholder="Confirmez votre mail" id="email2" name="email2" value="<?php if (isset($email2)) {
                                                                                                            echo $email2;
                                                                                                         } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="password">Mot de passe :</label>
            </td>
            <td>
               <input type="password" placeholder="Votre mot de passe" id="password" name="password" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="password2">Confirmation du mot de passe :</label>
            </td>
            <td>
               <input type="password" placeholder="Confirmez votre mdp" id="password2" name="password2" />
            </td>
         </tr>
         <tr>
            <td></td>
            <td align="center">
               <br />
               <input type="submit" name="forminscription" value="Je m'inscris" />
            </td>
         </tr>
      </table>
   </form>

   <nav class="navbar navbar-dark bg-dark">
      <!-- Navbar content -->

      <a button href="index.php">Welcome Page</a>
      <a href="register.php" class="active">Register</a>
      <a href="login.php">Log in</a>
   </nav>

   <section class="section pb-5">


      <h2 class="section-heading h1 pt-4 text-white text-center">Registration</h2>

      <div class="row">


         <div class="col-8 offset-2">


            <div class="card">
               <form method="POST" action="" class="card-body">
                  <div class="form-header">
                     <h3><i class="fas fa-envelope-square"></i> Please Fill in All the Blanks</h3>
                  </div>

                  <div class="md-form">
                     <label for="form-firstname">First Name</label>
                     <i class="fas fa-user prefix grey-text"></i>
                     <input type="text" name="firstname" id="firstname" class="form-control" value="<?php if (isset($firstname)) {
                                                                                                            echo $firstname;
                                                                                                         } ?>" />
                  </div>

                  <div class="md-form">
                     <label for="form-lastname">Last Name</label>
                     <i class="fas fa-user prefix grey-text"></i>
                     <input type="text" id="lastname" class="form-control" name="lastname" value="<?php if (isset($lastname)) {
                                                                                                         echo $lastname;
                                                                                                      } ?>" />
                  </div>

                  <div class="md-form">
                     <label for="form-nickname">Nickname</label>
                     <i class="fas fa-user prefix grey-text"></i>
                     <input type="text" id="username" class="form-control" name="username" value="<?php if (isset($username)) {
                                                                                                         echo $username;
                                                                                                      } ?>" />
                  </div>

                  <div class="md-form">
                     <label for="form-email">Your email</label>
                     <i class="fas fa-envelope prefix grey-text"></i>
                     <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($email)) {
                                                                                                echo $email;
                                                                                             } ?>" />
                  </div>

                  <div class="md-form">
                     <label for="form-email">Comfirm your email</label>
                     <i class="fas fa-envelope prefix grey-text"></i>
                     <input type="text" class="form-control" id="email2" name="email2" value="<?php if (isset($email2)) {
                                                                                                            echo $email2;
                                                                                                         } ?>" />
                  </div>

                  <div class="md-form">
                     <label for="form-password">Password</label>
                     <i class="fas fa-key"></i>
                     <input type="text" class="form-control" id="password" name="password" />
                  </div>

                  <input type="hidden" name="forminscription" value="any" />

                  <div class="md-form">
                     <label for="for-confirm">Confirm Password</label>
                     <i class="fas fa-key"></i>
                     <input type="text" class="form-control" id="password2" name="password2" />
                  </div>
                  <div class="text-center mt-4">
                     <button class="btn btn-light-blue">Submit</button>
                     <i class="fas fa-paper-plane"></i>
                  </div>

                  <div class ="text-center mt-4">
                  <?php
                   if (isset($erreur)) {
                  echo '<font color="red">' . $erreur . "</font>";
                     }
                  ?>
                  </div>
               </form>

            </div>


         </div>
        
   </section>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>

</html>