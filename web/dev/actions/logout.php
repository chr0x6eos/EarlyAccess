<?php
    if(isset($_POST['logout']))
    {
        include_once "../includes/session.php";
        session_destroy();
        header('Location: /index.php');
    }
    else
    {
        header('Location: /home.php');
    }
?>