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

if(isset($_SESSION['user']))
{
    $sql = $pdo->prepare("SELECT * FROM users WHERE id=?");
    $sql->execute([$_SESSION['user']['id']]);
    $user = $sql->fetch();
    
    // Check if user was found
    if ($user)
    {
        // Get username and hash
        $id = $user["id"];
        $name = $user["name"];
        // Store id & username in session
        $_SESSION['user'] = array();
        $_SESSION['user']['id'] = $id;
        $_SESSION['user']['name'] = $name;
    }
}

?>