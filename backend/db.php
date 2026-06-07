<?php 
function conectar() {
    $dbname = 'blog-crud';
    $host = "localhost";
    $username = 'root';
    $password = '';

    $pdo = new PDO ("mysql:host=$host; dbname=$dbname; charset=UTF8", $username, $password);
    return $pdo;
}

