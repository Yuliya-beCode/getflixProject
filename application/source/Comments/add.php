<?php
// On démarre une session
session_start();
  // On inclut la connexion à la base
  require_once('../db.php');
if($_POST){
    if(isset($_POST['comment']) && !empty($_POST['comment'])
){
      

        // On nettoie les données envoyées
        $comment = strip_tags($_POST['comment']);

        $sql = 'INSERT INTO `comments` (`comment`) VALUES (:comment);';

        $query = $pdo->prepare($sql);

        $query->bindValue(':comment', $comment, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['comments'] = "comment additionned";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "comment absent";
    }
}
require_once('../header.php');
?>
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
                <h1>Add commeent</h1>
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
    <?php require_once('../footer.php'); ?>
