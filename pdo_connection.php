<?php
// PDO gére la conection a la base de donnée 
$db_host = getenv('MYSQL_HOST');
if (!$db_host) {
    $db_host = '127.0.0.1';
}

$db_port = getenv('MYSQL_PORT');
if (!$db_port) {
    $db_port = '3306';
}

$dsn = 'mysql:dbname=average_db;host=' . $db_host . ':' . $db_port;
$user = 'root';
$password = '';

$option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $user, $password, $option);
} catch (PDOException $e) {
    echo $dsn;
    echo 'Connexion échouée : ' . $e->getMessage();
}