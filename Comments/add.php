<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['comment']) && !empty($_POST['comment'])
){
        // On inclut la connexion à la base
        require_once('config.php');

        // On nettoie les données envoyées
        $comment = strip_tags($_POST['comment']);

        $sql = 'INSERT INTO `comments` (`comment`) VALUES (:comment);';

        $query = $dbh->prepare($sql);

        $query->bindValue(':comment', $comment, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['comments'] = "Message ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>

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
                <h1>Ajouter un commentaire</h1>
                <form method="post">
     
                    <div class="form-group">
                        <label for="comment">comment</label>
                        <input type="text" id="comment" name="comment" class="form-control">

                    </div>
                   
                   
                    <button class="btn btn-primary">Poster</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>a