<?php
include "config.php";

if(isset($_SESSION['user'])){
    header('Location: game.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<title>EarlyAccess Game</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container">
    <form method="post" action="/login.php">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="email" name="email" placeholder="user@earlyaccess.htb"/>
            </div>
            <div>
                <input type="password" class="textbox" id="password" name="password" placeholder="password"/>
            </div>
            <div>
                <input type="submit"/>
            </div>
        </div>
    </form>
</div>
</html>
