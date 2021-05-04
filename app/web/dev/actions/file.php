<?php
include_once "../includes/session.php";

try
{
    set_include_path(".:.");

    if (isset($_GET['filepath']))
    {
        $path = $_GET['filepath'];

        // Prevent reading from outside of current dir
        if (strpos(urldecode($path), '/') !== 0 && strpos(urldecode($path), '..') === false && strpos(urldecode($path), '../') === false)
            include($path);
        else
            throw new Exception("For security reasons, reading outside the current directory is prohibited!");
    }
}
catch(Exception $ex)
{
    $_SESSION['error'] = htmlentities($ex->getMessage());
    header('Location: /home.php');
    return;
}