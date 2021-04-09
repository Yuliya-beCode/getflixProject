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
        if($_POST['remember']){
            $remeber_token = str_random(250);
$pdo->prepare('UPDATE FROM users SET remember_token')
        }
        die();

        header('Location: account.php');

        exit();
    } else {
        $_SESSION['flash']['danger'] = "id or password incorrect";
    }
}
?>


<?php require('header.php'); ?>
<h1>Login</h1>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Username or E-mail</label>>
        <input type="text" name="username" class="form-control" />

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" />
          
            <div class="form-group">
        <label>
        <input type="checkbox" name="remenber" value="1" /> Remember me.
        </label>>
            <button type="submit" class="btn-primary">connection</button>

</form>
<?php require('footer.php'); ?>