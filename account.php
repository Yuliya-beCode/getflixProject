<?php
require 'function.php';
logged_only();
if (!empty($_POST)) {

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $_SESSION['flash']['danger'] = 'Your passwords are different';
    } else {
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'db.php';
        $pdo->prepare('UPDATE users SET password = ?')->execute([$password]);
        $_SESSION['flash']['suscess'] = 'Your password has been updated';
    }
}

require('header.php');
?>


<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>

<form action="" method="POST">

    <div class="form-group">
        <input type="password" name="password" placeholder="Change your password." class="form-control" />
    </div>

    <div class="form-group">
        <input type="password" name="password_confirm" placeholder="Password confirmation" class="form-control" />
    </div>

    <button type="submit" class="btn-primary">Change password</button>

</form>

<?php require('footer.php'); ?>