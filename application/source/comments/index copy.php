<?php

session_start();
$sql = 'SELECT * FROM `users`, `comments` DELETE  FROM `comments`  WHERE `userid` = `id`';
// On prépare la requête
$query = $pdo->prepare($sql);
// On exécute la requête
$query->execute();
// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<pre> <?php 
print_r($result)
?>
</pre>
<?php


// Recuperation id user
$userid = $_SESSION['auth']->id;
$moovieidsql = $_POST['moovieid'];



// Add commment


if ($_POST) {
    if (
        isset($_POST['comment']) && !empty($_POST['comment'])
    ) {

        $comment = $_POST['comment'];
        $userid = $_SESSION['auth']->id;
        // Recuperation id film
        $moovieid = $_GET['movie'];
        $req = $pdo->prepare('INSERT INTO comments(comment, userid, moovieid) VALUES (?, ?, ?)');


        $req->execute(array($comment, $userid, $moovieid));


        $_SESSION['comments'] = "comment additionned";

        header('Location: comments/index.php');
    } else {
        $_SESSION['erreur'] = "comment empy";
    }
}



?>
</thead>

<section>
    <section>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <?php
                    if (!empty($_SESSION['erreur'])) {
                        echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                    ?>
                    <?php
                    if (!empty($_SESSION['message'])) {
                        echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                        $_SESSION['message'] = "";
                    }
                    ?>
                    <table class="table">
                        <thead>
                            <th>Username</th>
                            <th>Commentaire</th>




                        <tbody>
                            <?php
                            // On boucle sur la variable result

                         

                                    foreach ($result as $message) {
                                        $moovieid = $_GET['movie'];
                                        $userid2 = $message['id'];
                                        $userid3 = $message['userid'];

                                        if ($moovieid == $message['moovieid']){
                                            

                            ?>

                                            <tr>
                                                <td><?= $message['username'] ?></td>
                                                <td><?= $message['comment'] ?></td>

                                                <td> <a href="comments/edit.php?id=<?= $message['id'] ?>">Modifie</a> <a href="comments/delete.php?id=<?= $message['id'] ?>">Delete</a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                   
                     


                        </tbody>


                    </table>

                    <main class="container">
                        <div class="row">
                            <section class="col-12">
                                <?php
                                if (!empty($_SESSION['erreur'])) {
                                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
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
                </section>
            </div>
        </main>