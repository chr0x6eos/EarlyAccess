<?php

session_start();

$host = "mysql";
$db = "db";
$user = "dev";
$password = "dev";


function get_pdo($host="mysql",$db="db",$user="dev", $password="dev")
{
    $dsn = "mysql:host=".$host.";dbname=".$db;
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
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