<?php
include_once "../includes/session.php";

try
{
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
        }
        throw new Exception("Invalid username or password!");
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