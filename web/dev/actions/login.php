<?php
include_once "../includes/session.php";
include_once "../includes/ban.php";

try
{

    if(!allow_login($_SERVER['REMOTE_ADDR']))
    {
        throw new Exception("You have made too many failed login attempts! Please wait before trying again!");
    }

    if(isset($_POST['password']) && $_POST['password'] != "")
    {
        $password = $_POST['password'];

        $sql = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $sql->execute(["admin@earlyaccess.htb"]);
        $user = $sql->fetch();
        
        // Check if user was found
        if ($user)
        {
            // Verify login
            if(password_verify($password, $user["password"]))
            {
                // Store id in session
                $_SESSION['user'] = $user["id"];
                header('Location: /home.php');
                return;
            }
            else
            {
                failed_login($_SERVER['REMOTE_ADDR']); // Log failed login
                throw new Exception("Invalid password!");
            }
        }
        else
        {
            throw new Exception("[CRITICAL ERROR] Admin not found!");
        }
    }
    else
    {
        throw new Exception("Password required!");
    }
}
catch(Exception $ex)
{
    $_SESSION['error'] = htmlentities($ex->getMessage());
    header('Location: /index.php');
    return;
}
?>