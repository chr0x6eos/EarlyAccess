<?php

include "config.php";

//Verify user is logged in
if(!isset($_SESSION['user']))
{
    header('Location: index.php');
    return;
}
?>