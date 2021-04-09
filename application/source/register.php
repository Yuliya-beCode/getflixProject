<link rel="stylesheet" href="style.css">

<?php require_once('function.php'); ?>
<?php session_start(); ?>
<?php

if (!empty($_POST)) {

    $errors = array();
    require_once('db.php');



    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Username is not valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if ($user) {
            $errors['username'] = 'Username already exist !';
        }
    }


    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is not valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'E-Mail already exist !';
        }
    }


    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Invalid password";
    }

    if (empty($errors)) {
        $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token]);

        $user_id = $pdo->lastInsertId();
        mail($POST['email'], 'Confimation Token', "For validation click on this link\n\nhttp://localhost/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success'] = 'A confirmation email has been sent to you';
        exit();
    }
}


?>



<?php include 'header.php'; ?>



<div class="col-sm-8">

    <div class="card">
        <form method="POST" action="" class="card-body">
            <div class="form-header">
                <h3><i class="fas fa-envelope-square"></i> Please Fill in All the Blanks</h3>
            </div>



            <div class="md-form">
                <i class="fas fa-user prefix grey-text"></i>

                <label for="form-nickname">Username</label>

                <input type="text" id="username" class="form-control" name="username" value="" />

            </div>

            <div class="md-form">
                <i class="fas fa-envelope prefix grey-text"></i>

                <label for="form-email">Your email</label>

                <input type="text" class="form-control" id="email" name="email" value="" />


            </div>


            <div class="md-form">
                <i class="fas fa-key"></i>
                <label for="form-password">Password</label>
                <input type="text" class="form-control" id="password" name="password" />

            </div>




            <input type="hidden" name="forminscription" value="any" />

            <div class="md-form">
                <i class="fas fa-key"></i>
                <label for="for-confirm" style="width: max-content">Confirm Password</label>
                <input type="text" class="form-control" id="password_confirm" name="password_confirm" />




            </div>
            <div class="text-center mt-4">
                <button class="btn btn-light-blue" name="forminscription">Submit</button>
                <i class="fas fa-paper-plane"></i>
            </div>


        </form>

    </div>


</div>


<?php include 'footer.php'; ?>