<?php
    include_once "includes/session.php";
?>

<!DOCTYPE html>
<html lang="en">
	<?php include_once "includes/header.php"; ?>
    <body>
        <?php include_once "includes/menu.php";?>
        <div class="container">
        <div class="container fill">
            <div class="panel panel-default fill">
                <div class="panel-heading center"><h1>Scoreboard</h1></div>
                    <div class="panel-body fill">
                        <div class="card header fill">
                            <div class="card-header center">
                                Your best 10 scores
                            </div>
                            <div class="card-body fill overflow">
                            <?php
                                try
                                {
                                    $sql = $pdo->prepare("SELECT count(*) as sum FROM scoreboard WHERE user_id=?");
                                    $sql->execute([$_SESSION['user']['id']]);
                                    $res = $sql->fetch();

                                    // Only print scoreboard, if already played
                                    if((int)$res['sum'] > 0)
                                    {
                                        // Seconder order injection:
                                        $sql = $pdo->prepare("SELECT scoreboard.score, scoreboard.time, users.name FROM scoreboard INNER JOIN users ON (users.id=scoreboard.user_id) WHERE users.name=('" . $_SESSION["user"]["name"]. "') ORDER BY scoreboard.score DESC LIMIT 10");
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
                                    }
                                    else
                                    {
                                        echo '<h3>You don\'t have any high-scores yet! Play the game to start filling your scoreboard.</h3>';
                                        echo '<a class="btn btn-outline-success" href="/game.php">Play now!</a>';
                                    }
                                }
                                catch(Exception $ex)
                                {
                                    $_SESSION['error'] = htmlentities($ex->getMessage());
                                }
                                include_once "includes/error.php";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>