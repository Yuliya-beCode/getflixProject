<?php

session_start();
// require_once('db.php');
include('db.php');

if (isset($_POST['comment']) && !empty($_POST['comment'])) {

    $comment = $_POST['comment'];
    $userid = $_SESSION['auth']->id;
    // Recuperation id film
    $moovieid = $_GET['movie'];
    $req = $pdo->prepare('INSERT INTO comments(comment, userid, moovieid) VALUES (?, ?, ?)');

    $req->execute(array($comment, $userid, $moovieid));

    unset($_POST['comment']);
    // header('Location: comments/index.php');
} elseif (isset($_POST['comment']) and empty($_POST['comment'])) {
    $_SESSION['erreur'] = "comment empy";
}

$moovieid = $_GET['movie'];
// $sql_comms = 'SELECT * FROM comments WHERE moovieid= ?'; //TO filter comments by movieid
// $sql_comms = 'SELECT * FROM comments';
// $sql_comms = 'SELECT * FROM comments LEFT JOIN users ON comments.userid = users.id';
$sql_comms = 'SELECT * FROM comments LEFT JOIN users ON comments.userid = users.id WHERE moovieid= ?';
// On prépare la requête
$query_comms = $pdo->prepare($sql_comms);
// On exécute la requête
$query_comms->execute(array($moovieid));
// On stocke le résultat dans un tableau associatif
$result_comms = $query_comms->fetchAll(PDO::FETCH_ASSOC);

// Recuperation id user
$userid = $_SESSION['auth']->id;
// Add commment
?>

<div class="container">
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
            <table class="table table-bordered">
                <thead class="table-dark">
                    <th>Username</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </thead>

                <tbody>
                    <?php
                    // On boucle sur la variable result
                    foreach ($result_comms as $message) {
                    ?>
                        <tr><?php
                            echo '<td>' . $message['username'] . '</td>';
                            if (isset($_POST['edit']) and $message['id2'] == $_POST['id']) {
                                echo '<form action="process.php" method="POST">';
                                echo '<td><input type="text" name="commentText" class="form-control" value="" placeholder="' . $message['comment'] . '"></td>';
                            } else {
                                echo '<td>' . $message['comment'] . '</td>';
                            }
                            if ($message['id'] == $userid) { ?>
                                <td class="d-flex justify-content-end">
                                    <?php
                                    if (isset($_POST['edit']) and $message['id2'] == $_POST['id']) {
                                    ?>

                                        <input type='hidden' name='movie' value="<?php echo $moovieid; ?>">
                                        <input type='hidden' name='commentId' value="<?php echo $message['id2']; ?>">
                                        <input type="submit" name="update" value="Update">
                                        </form>
                                    <?php } else { ?>

                                        <form method="POST">
                                            <input type='hidden' name='id' value="<?php echo $message['id2']; ?>">
                                            <input type="submit" name="edit" value="Edit">
                                        </form>

                                    <?php } ?>
                                    <form action="process.php" method="POST">
                                        <input type='hidden' name='movie' value="<?php echo $moovieid; ?>">
                                        <input type='hidden' name='id' value="<?php echo $message['id2']; ?>">
                                        <input type="submit" name="delete" value="Delete">
                                    </form>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<section class="col-12">';
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
                echo '</section class="mb-3">';
                $_SESSION['erreur'] = "";
            }
            ?>
            <section>
                <form method="POST" class="input-group mb-3">
                    <input type="text" class="form-control" name="comment" placeholder="Write your comment here" aria-label="Write your comment here" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Comment</button>
                </form>
            </section>
        </section>
    </div>
</div>