<?php
include "../includes/session.php";

try
{
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email != "" && $password != "")
        {
            $sql = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $sql->execute([$email]);
            $user = $sql->fetch();
            
            // Check if user was found
            if ($user)
            {
                // Get username and hash
                $id = $user["id"];
                $name = $user["name"];
                $hash = $user["password"];
                $key = $user["key"];

                if(password_verify($password,$hash))
                {
                    if ($name == "admin" || $key != "")
                    {
                        // Store id & username in session
                        $_SESSION['user'] = array();
                        $_SESSION['user']['id'] = $id;
                        $_SESSION['user']['name'] = $name;
                        header('Location: /game.php');
                    }
                    else
                    {
                        throw new Exception("The account has no EarlyAccess-Key linked! Please link your game key to your account to continue.");
                    }
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
    $_SESSION['error'] = htmlentities($ex->getMessage());
    header('Location: /index.php');
}