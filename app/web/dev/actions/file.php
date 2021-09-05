<?php
include_once "../includes/session.php";

try
{
    set_include_path(".:.");

    if (isset($_GET['filepath']))
    {
        $path = urldecode($_GET['filepath']);

        // Prevent reading from outside of current dir
        if (strpos($path, '/') !== 0 && strpos($path, '..') === false && strpos($path, '../') === false)
        {
            // Allow strings that start with php://filter/convert.base64- and end with .php     OR      Allow strings that do not contain "/" and end with .php
            if((substr($path, 0, strlen("php://filter/convert.base64-")) === "php://filter/convert.base64-" && substr(urldecode($path), -strlen(".php")) === ".php") || (!strpos($path, "/") && substr($path, -strlen(".php")) === ".php"))
            {
                echo "<h2>Executing file:</h2><p>$path</p><br>";
                require_once($path);
                echo "<h2>Executed file successfully!";
                return;
            }
            else
                throw new Exception("Only .php files can be read!");
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