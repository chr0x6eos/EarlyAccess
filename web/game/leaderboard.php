<?php
    include "includes/session.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php include "includes/header.php"; ?>
    <body>
        <?php include "includes/menu.php";?>
        <div class="container">
        <div class="container fill">
            <div class="panel panel-default fill">
                <div class="panel-heading center"><h1>Global Leaderboard</h1></div>
                    <div class="panel-body fill">
                        <div class="card header fill">
                            <div class="card-header center">
                                The best 10 players of today
                            </div>
                            <div class="card-body fill overflow">
                            <?php
                                try
                                {
                                    $sql = $pdo->prepare("SELECT count(*) as sum FROM scoreboard");
                                    $sql->execute([$_SESSION['user']['id']]);
                                    $res = $sql->fetch();

                                    // Only print scoreboard, if already played
                                    if((int)$res['sum'] > 0)
                                    {
                                        //$sql = $pdo->prepare("SELECT scoreboard.user_id, scoreboard.score, scoreboard.time, users.email FROM scoreboard INNER JOIN users ON (users.id=scoreboard.user_id) ORDER BY scoreboard.score DESC LIMIT 10");
                                        $sql = $pdo->prepare("SELECT res.user_id, res.score, res.time, res.email FROM (SELECT scoreboard.user_id, scoreboard.score, scoreboard.time, users.email FROM scoreboard INNER JOIN users ON (users.id=scoreboard.user_id) ORDER BY scoreboard.score DESC LIMIT 10) as res GROUP BY res.user_id");
                                        $sql->execute();
                                        echo '
                                        <table class="table center">
                                            <thead>
                                                <tr>
                                                    <th>Rank</th>
                                                    <th>User-Email</th>
                                                    <th>Score</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                        
                                        $rank = 0;
                                        while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $rank += 1;

                                            if($_SESSION['user']['id'] == $row["user_id"])
                                            {
                                                echo '<tr class="highlight">';
                                            }
                                            else
                                            {
                                                echo '<tr>';
                                            }
                                                // Display email to prevent hinting other users about the SQLi
                                                echo '<td>' . $rank . '</td>';
                                                echo '<td>' . $row["email"] . '</td>';
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
                                        echo '<h3>The leaderboard is currently empty. Play the game to secure your place on the board!</h3>';
                                        echo '<a class="btn btn-outline-success" href="/game.php">Play now!</a>';
                                    }
                                }
                                catch(Exception $ex)
                                {
                                    $_SESSION['error'] = htmlentities($ex->getMessage());
                                }
                                include "includes/error.php";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>