<?php
function debug($variable)
{
    echo print_r($variable, true);
}

function str_random($lenght)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}

function logged_only()
{

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    if (!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = 'You do not have the right to connect on this page!';
        header('Location: login.php');
        exit();
    }
}
