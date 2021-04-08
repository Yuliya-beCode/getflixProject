<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('config.php');

$sql = 'SELECT * FROM `comments`';

// On prépare la requête
$query = $dbh->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des commentaires</title>

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
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste des comentaires</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Commentaire</th>
                        <th>Parrent_id</th>
                
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $message){
                        ?>
                            <tr>
                                <td><?= $message['id'] ?></td>
                                <td><?= $message['comment'] ?></td>
                                <td><?= $message['parent_id'] ?></td>
                   
                                <td><a href="details.php?id=<?= $message['id'] ?>">Voir</a> <a href="edit.php?id=<?= $message['id'] ?>">Modifier</a> <a href="delete.php?id=<?= $message['id'] ?>">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un commentaire</a>
            </section>
        </div>
    </main>
</body>
</html>