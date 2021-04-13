<?php require_once('function.php'); ?>
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
        $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute([$_POST['username'], $password, $_POST['email']]);


    }
}


?>


<?php include 'header.php'; ?>

    <h1>Register</h1>
    <div class="col-sm d-flex justify-content-center align-content-center pt-2">

        <div class="row bg-white rounded-2">
            <form method="POST" action="" class="card-body">
                <div class="form-header form-control-sm">
                    <h3><i class="fas fa-envelope-square"></i> Please Fill in All the Blanks</h3>
                </div>


                <div class="md-form form-control-sm">
                    <i class="fas fa-user prefix grey-text"></i>

                    <label for="form-nickname">Username</label>

                    <input type="text" id="username" class="form-control" name="username" value=""/>

                </div>

                <div class="md-form form-control-sm">
                    <i class="fas fa-envelope prefix grey-text"></i>

                    <label for="form-email">Your email</label>

                    <input type="text" class="form-control" id="email" name="email" value=""/>


                </div>


                <div class="md-form form-control-sm">
                    <i class="fas fa-key"></i>
                    <label for="form-password">Password</label>
                    <input type="text" class="form-control" id="password" name="password"/>

                </div>


                <input type="hidden" name="forminscription" value="any"/>

                <div class="md-form form-control-sm">
                    <i class="fas fa-key"></i>
                    <label for="for-confirm" style="width: max-content">Confirm Password</label>
                    <input type="text" class="form-control" id="password_confirm" name="password_confirm"/>


                </div>
                <div class="text-center mt-4">
                       <span class="border rounded-3 p-2">
                    <button class="btn btn-light-blue" name="forminscription">Submit</button>
                    <i class="fas fa-paper-plane"></i>
                       </span>
                </div>


            </form>

        </div>


    </div>


<?php include 'footer.php'; ?>