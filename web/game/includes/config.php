<?php

session_start();

$host = "mysql";
$user = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];
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