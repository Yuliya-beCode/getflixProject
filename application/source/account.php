<?php

    session_start();
?>
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

include('header.php');
?>
<div class="container">
<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>



<form action="" method="POST">
   
    <div class="form-group text-center align-middle m-3 ">
        <input type="password" name="password" placeholder="Change your password." class="md-form " />
    </div>

    <div class="form-group  text-center align-middle m-3 ">
        <input type="password" name="password_confirm" placeholder="Password confirmation" class="md-from" />
    </div>
    <div class="form-group  text-center align-middle ">
    <button type="submit" class="btn-primary">Change password</button>
    </div>
    </div>
</form>
</div>
<?php include('footer.php'); ?>