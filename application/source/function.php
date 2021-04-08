<?php 
function debug($variable){
    echo  print_r($variable, true);
} 

function str_random($lenght){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    substr(str_shuffle(str_repeat($alphabet, $lenght)),0, $lenght);
} 