<?php

include "config.php";

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<?php include "header.php"; ?>
    <body>
        <?php include "menu.php";?>
        <div class="container">
        <div class="container fill">
            <div class="panel panel-default fill">
                <div class="panel-heading center"><h1>Game version v0.1.2.733</h1></div>
                    <div class="panel-body fill">
                        <div class="card header fill">
                            <div class="card-header center">
                                Your most recent scores
                            </div>
                            <div class="card-body fill">
                            <?php
                                try
                                {
                                    /*$sql = $pdo->prepare("SELECT count(*) FROM scoreboard INNER JOIN users ON (users.id=scoreboard.user_id) WHERE users.name=('" . $_SESSION["user"]["name"] . "')");
                                    $sql->execute();
                                    
                                    $scores = $sql->fetch();

                                    if ($scores)
                                    {*/
                                    $sql = $pdo->prepare("SELECT * FROM users WHERE id=?");
                                    $sql->execute([$_SESSION['user']['id']]);
                                    $user = $sql->fetch();

                                    // Check if user was found
                                    if (!$user)
                                    {
                                        $_SESSION['error'] = "The user with the name " . htmlentities($_SESSION['user']['name']) . " does not exist anymore!";
                                        session_destroy();
                                        header('Location: index.php');
                                        return;
                                    }
                                    // Seconder order injection:
                                    $sql = $pdo->prepare("SELECT scoreboard.score, scoreboard.time, users.name FROM scoreboard INNER JOIN users ON (users.id=scoreboard.user_id) WHERE users.name=('" . $_SESSION["user"]["name"]. "') ORDER BY scoreboard.time DESC");
                                    $sql->execute();
                                    echo '
                                    <table class="table center">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Score</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                                    {
                                        echo '<tr>';
                                        echo '<td>' . $row["name"] . '</td>';
                                        echo '<td>' . $row["score"] . '</td>';
                                        echo '<td>' . $row["time"] . '</td>';
                                        echo '</tr>';
                                    }
                                    
                                    echo '</tbody>
                                    </table>
                                    ';
                                    /*}
                                    else
                                    {
                                        echo '<h2 class="center">No scores!</h2>';
                                    }*/
                                }
                                catch(Exception $ex)
                                {
                                    echo "<p class=\"error\">" . htmlentities($ex->getMessage()) . "</p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>