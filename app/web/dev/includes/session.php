<?php

include_once "config.php";

//Verify admin is logged in
if(!isset($_SESSION['admin']))
{
    header('Location: /index.php');
    return;
}
?>