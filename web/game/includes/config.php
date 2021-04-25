<?php

session_start();

$host = "mysql";
$user = "game"; //$_ENV['MYSQL_USER'];
$password = $_ENV['GAME_PW']; //$_ENV['MYSQL_PASSWORD'];
$db = $_ENV['MYSQL_DATABASE'];

$dsn = "mysql:host=".$host.";dbname=".$db;

try
{
    $pdo = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e)
{
    die('Could not connect to database: ' . $e);
}
?>