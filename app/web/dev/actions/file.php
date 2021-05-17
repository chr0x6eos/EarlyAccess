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
        {
            echo "<h2>Executing file:</h2><p>$path</p><br>";
            require_once($path);
            echo "<h2>Executed file successfully!";
            return;
        }
        else
            throw new Exception("For security reasons, reading outside the current directory is prohibited!");
    }
    throw new Exception("Please specify file!");
}
catch(Exception $ex)
{
    http_response_code(500);
    echo '<h1>ERROR:</h1>' . htmlentities($ex->getMessage());
    return;
}