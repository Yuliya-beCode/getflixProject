<?php
// On démarre une session
session_start();

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('config.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `comments` WHERE `id` = :id;';

    // On prépare la requête
    $query = $dbh->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $messages = $query->fetch();

    // On vérifie si le produit existe
    if(!$messages){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
        die();
    }

    $sql = 'DELETE FROM `comments` WHERE `id` = :id;';

    // On prépare la requête
    $query = $dbh->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['comments'] = "Message supprimé";
    header('Location: index.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
?>