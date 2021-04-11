<?php 

session_start();

    require_once 'db.php';
    require_once 'function.php';

    
    require_once 'header.php';


$sql = 'SELECT * FROM `users`, `comments`';
// On prépare la requête
$query = $pdo->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Recuperation id film
$moovie_id = $_GET['movie'];
// Recuperation id user
$user_id = (int)$_SESSION['auth']->id;


// Add commment
echo $user_id

?>