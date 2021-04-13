<?php
session_start();
require_once('db.php');


$comment = '';
$id = 0;


if (isset($_POST['comment']) && !empty($_POST['comment'])) {
    $moovieid = $_POST['movie'];
    $comment = $_POST['comment'];
    $userid = $_SESSION['auth']->id;
    // Recuperation id film
    $req = $pdo->prepare('INSERT INTO comments(comment, userid, moovieid) VALUES (?, ?, ?)');

    $req->execute(array($comment, $userid, $moovieid));

    unset($_POST['comment']);
    header('Location: info.php?movie=' . $moovieid);
    // header('Location: comments/index.php');
} elseif (isset($_POST['comment']) and empty($_POST['comment'])) {
    $moovieid = $_POST['movie'];
    unset($_POST['comment']);
    $_SESSION['erreur'] = "comment empy";
    header('Location: info.php?movie=' . $moovieid);
}


if (isset($_POST['delete'])) {
    $moovieid = $_POST['movie'];
    $commentId = $_POST['id'];
    $sql = 'DELETE FROM comments WHERE id2 = :id';
    // On prépare la requête
    $query = $pdo->prepare($sql);
    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $commentId, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute();
    unset($_POST['delete']);
    header('Location: info.php?movie=' . $moovieid);
}

if (isset($_POST['update'])) {
    $moovieid = $_POST['movie'];
    $commentId = $_POST['commentId'];
    $commentText = $_POST['commentText'];
    $query = $pdo->prepare('UPDATE comments SET comment= :comment WHERE id2= :id');
    $query->bindValue(':comment', $commentText, PDO::PARAM_STR);
    $query->bindValue(':id', $commentId, PDO::PARAM_INT);
    $query->execute();
    header('Location: info.php?movie='.$moovieid);
}
