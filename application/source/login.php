<?php if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    require_once 'db.php';
    require_once 'function.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE username = :username  OR email = :username');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if (password_verify($_POST['password'], $user->password)) {
        session_start();

        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Your are connected !";

    }
}
?>


<?php include('header.php'); ?>
    <h1>Login</h1>

    <div class="d-flex justify-content-center align-content-center">
        <form action="" method="POST" class="bg-white rounded-2 p-5">

            <div class="form-group">
                <label for="">Username or E-mail</label>
                <input type="text" name="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control"/>
            </div>
            <div class="form-group">

                <button type="submit" class="btn btn-primary d-block mx-auto w-100 mt-4">connection</button>
            </div>
        </form>
    </div>
<?php include('footer.php'); ?>