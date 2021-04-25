<?php

include_once "config.php";

//Verify user is logged in
if(!isset($_SESSION['user']))
{
    header('Location: /index.php');
    return;
}
?>