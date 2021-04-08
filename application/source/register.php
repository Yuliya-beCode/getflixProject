<?php require_once('function.php'); ?>
<?php 
if(!empty($_POST)){

    $errors = array();
    require_once ('db.php');

    

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Username is not valide";
    } else  {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]); 
        $user = $req->fetch();
        if($user){
            $errors['username'] = 'Username already exist !';
     
        }

    }


    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email is not valide";
    } else  {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]); 
        $user = $req->fetch();
        if($user){
            $errors['email'] = 'E-Mail already exist !';
       
        }
    }


    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Invalid password";
    }

    if(empty($errors)){
$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?,confirmation_token = ?");
$password = password_hash($$_POST['password'], PASSWORD_BCRYPT);
$token = str_random(60);
$req->execute([$_POST['username'], $password, $_POST['email'], $token]); 

$user_id = $pdo->lastInsertId();
mail($POST['email'], 'Confimation Token', "For validation click on this link\n\nhttp://localhost/confirm.php?id=$user_id&token=$token");
header('Location: login.php');
exit();

    }
 


    debug($errors); 

    
}


?>


<?php require('header.php'); ?>

<div class="container-fluid">
    <section class="section pb-5">


        <h2 class="section-heading h1 pt-4 text-white text-center">Registration</h2>
      
      
      
      
        <?php if(!empty($errors)): ?>
<div class="alert alert-danger">
    <p>You have not completed the form correctly</p>
    <ul>
    <?php foreach($errors as $error): ?>
        <li><?=$error; ?></li>
        <?php endforeach; ?></ul>
    
</div>
<?php endif; ?>


        <div class="row d-flex justify-content-center">


            <div class="col-8 ">


           
                    <h3>Please Fill in All the Blanks</h3>
       


                        <form action="" method="POST">

                        <div class="form-group">
                            <label for="">Username</label>>
                            <input type="text" name="username" class="form-control"/>

                            <div class="form-group">
                            <label for="">Email</label>>
                            <input type="mail" name="email" class="form-control"/>

                            <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control"/>

                            <div class="form-group">
                            <label for="">Confirm password</label>>
                            <input type="password" name="password_confirm" class="form-control"/>

<button type="submit" class="btn-primary">Inscription</button>

                        </form>

    </section>

</div>



<?php require 'footer.php'; ?>