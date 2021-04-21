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

        $sql = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $sql->execute([$_SESSION['user']['id']]);
        $user = $sql->fetch();
        
        // Check if user was found
        if ($user)
        {
            $id = $user["id"];

            $sql = $pdo->prepare("INSERT INTO scoreboard (score, user_id) VALUES (?,?)");
            $sql->execute([$score, $id]); 

            header('Location: game.php');
        }
        else
        {
            $_SESSION['error'] = "The user with the name " . htmlentities($_SESSION['user']['name']) . " does not exist anymore!";
            session_destroy();
            header('Location: index.php');
        }
    }
    else
    {
        throw new Exception('No score inputted!');
    }
}
catch(Exception $ex)
{
    $_SESSION['error'] = $ex->getMessage();
    header('Location: game.php');
}