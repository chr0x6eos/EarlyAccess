<?php
        try 
        {
                if(isset($_SESSION["user"]) && isset($_GET['score']))
                {
                        $pdo = getPDO();

                        // Save into scoreboard
                        $query = $pdo->prepare("INSERT INTO scoreboard(`userid`, `score`, `time`) VALUES(?, ?, ?)");  
                        $query->execute(array($_SESSION['user']['id'], $_GET["score"], current_time()));

                        // Seconder order injection:
                        $query = $pdo->prepare("SELECT scoreboard.score, scoreboard.time FROM scoreboard INNER JOIN users ON (users.id=scoreboard.userid) WHERE users.username=('$_SESSION[user]') ORDER BY scoreboared.time DESC");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                echo "<div class=\"notes\"><p class=\"title\">" . $row["title"] . "</p><p>" . str_replace("\n", "<br>", htmlentities($row["text"])) . "</p></div>";
                        }
                }
                else
                {
                        header("Location: index.php");                                                         
                        die();
                }
        } 
        catch (PDOException $e) {
                echo "<p class=\"error\">" . htmlentities($e->getMessage()) . "</p>";
        }
?>