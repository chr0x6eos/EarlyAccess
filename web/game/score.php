<?php

include "config.php";

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}

try
{
    if(isset($_GET['score']))
    {
        $score = $_GET['score'];

        $sql = $pdo->prepare("select * from users where name=?");
        $sql->execute([$_SESSION['name']]);
        $user = $sql->fetch();
        
        // Check if user was found
        if ($user)
        {
            // Get username and hash
            $name = $user["name"];
            $hash = $user["password"];

            if(password_verify($password,$hash))
            {
                // Store username in session
                $_SESSION['user'] = $name;
                header('Location: game.php');
            }
            else
            {
                throw new Exception("Invalid username or password!");
            }
        }
        else
        {
            throw new Exception("Invalid username or password!");
        }
    }
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}