<?php
include_once "../includes/session.php";

try
{
    // Use inputted hash_function to hash password
    if(isset($_GET['hash_function']) && isset($_GET['password']))
    {
        $hash = $_GET['hash_function']($_GET['password']);

        echo "Result for Hash-function (" . $_GET['hash_function'] . ") and password (" . $_GET['password'] . "):<br>";
        echo '<br>' . $hash;
    }
}
catch(Exception $ex)
{
    $_SESSION['error'] = htmlentities($ex->getMessage());
    header('Location: /home.php');
    return;
}
?>