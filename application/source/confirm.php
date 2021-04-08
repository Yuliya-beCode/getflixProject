<?php
$user_id = $GET['id'];
$token  = $_GET['token'];
require ('db.php');
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
session_start();

$user = $req->fetch();
    session_start();
    $_SESSION['auth'] = $user;
    header('Location: account.php');


/*     if($user && $user->confirmation_token == $token){
        session_start();
        $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW(), WHERE id=?')->execute();
        $_SESSION['auth'] = $user;
        header('Location: account.php');
    }else{
        $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
        header('Location: login.php');
    } */