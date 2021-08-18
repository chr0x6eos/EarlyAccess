<?php
include_once "../includes/session.php";
include_once "../includes/ban.php";

try
{
    if(!allow_login($_SERVER['REMOTE_ADDR']))
    {
        throw new Exception("You have made too many failed login attempts! Please wait before trying again!");
    }

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
                $key = $user["key"];

                if(sha1($password) === $user["password"])
                {
                    if ($name == "admin" || $key != "")
                    {
                        // Store id & username in session
                        $_SESSION['user'] = array();
                        $_SESSION['user']['id'] = $id;
                        $_SESSION['user']['name'] = $name;
                        header('Location: /game.php');
                    }
                    else // No game-key registered
                    {
                        throw new Exception("The account has no EarlyAccess-Key linked! Please link your game key to your account to continue.");
                    }
                }
                else // Password incorrect
                {
                    failed_login($_SERVER['REMOTE_ADDR']); // Log failed login
                    throw new Exception("Invalid username or password!");
                }
            }
            else // User not found
            {
                failed_login($_SERVER['REMOTE_ADDR']); // Log failed login
                throw new Exception("Invalid username or password!");
            }
        }
        else // No email or password specified
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