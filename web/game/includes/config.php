<?php

session_start();

$host = "mysql";
$db = "db";
$user = "game";
$password = "game";


function get_pdo($host="mysql",$db="db",$user="game", $password="game")
{
    $dsn = "mysql:host=".$host.";dbname=".$db;
    return new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

try
{
    $pdo = get_pdo($host,$db,$user,$password);
}
catch(Exception $e)
{
    die('Could not connect to the database!');
}
?>