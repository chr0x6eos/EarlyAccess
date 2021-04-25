<?php
include "../includes/session.php";

try
{
    if (isset($_GET['filepath']))
    {
        $path = $_GET['filepath'];

        if (strpos(urldecode($path), '..') === false && strpos(urldecode($path), '/') === false)
            include($path);
        else
            throw new Exception("For security reasons, reading outside the directories is not allowed!");
    }
}
catch(Exception $ex)
{
    $_SESSION['error'] = htmlentities($ex->getMessage());
    header('Location: /home.php');
    return;
}