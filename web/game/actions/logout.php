<?php
    if(isset($_POST['logout']))
    {
        include "../includes/session.php";
        session_destroy();
        header('Location: /index.php');
    }
    else
    {
        header('Location: /game.php');
    }
?>