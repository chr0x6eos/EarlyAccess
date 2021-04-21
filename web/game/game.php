<?php

include "config.php";
include "menu.php";

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<title>EarlyAccess Game</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container">
    <h1>Game version v0.1.2.733</h1>
</div>
</html>