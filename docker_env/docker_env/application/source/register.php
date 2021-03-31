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
                     $erreur = "Votre compte a bien été créé ! <a href=\"index.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre username ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>


Partie affichage (HTML)
<html>

<head>
   <title>TUTO PHP</title>
   <meta charset="utf-8">
</head>

<body>
   <div align="center">
      <h2>Inscription</h2>
      <br /><br />
      <form method="POST" action="">
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
      <?php
      if (isset($erreur)) {
         echo '<font color="red">' . $erreur . "</font>";
      }
      ?>
   </div>
</body>

</html>