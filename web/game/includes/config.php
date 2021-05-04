<?php

session_start();

$host = "mysql";
$db = "db";
$user = "game";
$password = "game";


function get_pdo($host="mysql",$db="db",$user="game", $password="game")
{
    $dsn = "mysql:host=".$host.";dbname=".$db;
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Setup SQL_mode
    $pdo->exec('SET SESSION sql_mode=\'ANSI_QUOTES,ERROR_FOR_DIVISION_BY_ZERO,IGNORE_SPACE,NO_ENGINE_SUBSTITUTION,NO_ZERO_DATE,NO_ZERO_IN_DATE,PIPES_AS_CONCAT,REAL_AS_FLOAT,STRICT_ALL_TABLES\'');
    $pdo->exec('SET SESSION innodb_strict_mode = on');
    return $pdo;
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