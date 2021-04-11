<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['comment']) && !empty($_POST['comment'])
    
){
        // On inclut la connexion à la base
        require_once('../db.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $messages = strip_tags($_POST['comment']);
        $prix = strip_tags($_POST['parent_id']);

        $sql = 'UPDATE `comments` SET `comment`=:comment, `parent_id`=:parent_id WHERE `id`=:id;';

        $query = $pdo->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':comment', $messages, PDO::PARAM_STR);
        $query->bindValue(':parent_id', $prix, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['comments'] = "Message modifié";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('config.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `comments` WHERE `id` = :id;';

    // On prépare la requête
    $query = $pdo->prepare($sql);

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
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier un produit</h1>
                <form method="post">
        
                    <div class="form-group">
                        <label for="comment">comment</label>
                        <input type="text" id="comment" name="comment" class="form-control" value="<?= $messages['comment']?>">

                    </div>
                    <div class="form-group">
                        <label for="parent_id">parent_id</label>
                        <input type="number" id="parent_id" name="parent_id" class="form-control" value="<?= $messages['parent_id']?>">
                    </div>
                    <input type="hidden" value="<?= $messages['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>