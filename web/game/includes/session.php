<?php

include_once "config.php";

// Update user on each page-load
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
    else
    {
        // User does not exist anymore, delete session
        session_destroy();
        header('Location: /index.php');
        return;
    }
}
else
{
    header('Location: /index.php');
    return;
}
?>