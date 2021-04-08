<?php
$user_id = $GET['id'];
$token  = $_GET['token'];
require('db.php');
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
session_start();

$user = $req->fetch();
session_start();
$_SESSION['auth'] = $user;
header('Location: account.php');


/*     if($user && $user->confirmation_token == $token){
        $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW(), WHERE id=?')->execute();
                $_SESSION['flash']['success'] = "Your account has been validated!";

        $_SESSION['auth'] = $user;
        header('Location: account.php');
    }else{
        $_SESSION['flash']['danger'] = "This token is no longer valid";
        header('Location: login.php');
    } */