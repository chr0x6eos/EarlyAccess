<?php
include "config.php";

try
{
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email != "" && $password != "")
        {
            $sql = $pdo->prepare("select * from users where email=?");
            $sql->execute([$email]);
            $user = $sql->fetch();
            
            // Check if user was found
            if ($user)
            {
                // Get username and hash
                $id = $user["id"];
                $name = $user["name"];
                $hash = $user["password"];

                if(password_verify($password,$hash))
                {
                    // Store id & username in session
                    $_SESSION['user'] = array();
                    $_SESSION['user']['id'] = $id;
                    $_SESSION['user']['name'] = $name;
                    header('Location: game.php');
                }
                else
                {
                    throw new Exception("Invalid username or password!");
                }
            }
            else
            {
                throw new Exception("Invalid username or password!");
            }
        }
        else
        {
            throw new Exception("Email and password required!");
        }
    }
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}