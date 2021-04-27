<?php
include_once "config.php";

// Insert IP to failed_logins table
function failed_login(string $ip)
{
    // Connect to database
    $pdo = get_pdo();

    $longip = ip2long($ip);

    // Save IP as failed login
    $pdo->prepare("INSERT INTO failed_logins (ip) VALUES (?)")->execute([$longip]);
}

// Checks if failed_logins in the last $minutes exceed $max_tries
function allow_login(string $ip, int $minutes=1, int $max_tries=10)
{
    // Connect to database
    $pdo = get_pdo();

    $longip = ip2long($ip);

    // Get all failed logins from the last $minutes
    $sql = $pdo->prepare("SELECT count(*) FROM failed_logins WHERE ip=? AND time BETWEEN DATE_SUB(NOW() , INTERVAL ? MINUTE) AND NOW()");
    $sql->execute([$longip, $minutes]);
    $res = $sql->fetch();
    if ($res)
    {
        
        return (int) $res[0] < $max_tries;
    }
    return true;
}