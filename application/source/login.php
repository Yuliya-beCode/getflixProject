<?php if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    require_once 'db.php';
    require_once 'function.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE username = :username  OR email = :username');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if (password_verify($_POST['password'], $user->password)) {
        session_start();
        $_SESSION['id'] = $user_id;
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Your are connected !";
        header('Location: index.php');
    }
}
?>





<?php include('header.php'); ?>

<main class="container-fluid">
<h1>Login</h1>


<div class="d-flex justify-content-center align-content-center pb-0 mb-0">

    <div class="bg-white rounded-2">
        <form action="" method="POST" class="card-body">


            <div class="form-header">
                <h3><i class="fas fa-envelope-square"></i> Please Fill in All the Blanks</h3>
            </div>

            <div class="md-form form-control-sm">
                <i class="fas fa-user prefix grey-text"></i>
                <input type="hidden" name="user_id" value="<?php echo "" . $user_id . "" ?>"></input>
                <div class="form-group">
                    <label for="">Username or E-mail</label>
                    <input type="text" name="username" class="form-control" />
                </div>

                <div class="md-form form-control-sm">
                    <i class="fas fa-key"></i>
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" />
                </div>

                <div class="text-center mt-4 form-control-sm">
                    <i class="fas fa-paper-plane"></i>
                    <span class="border rounded p-1">

                        <button type="submit" class="btn btn-light-blue">Connection</button>
                    </span>
                </div>
                </div>
        </form>
    </div>
</div>

</main>

<?php include('footer.php'); ?>

