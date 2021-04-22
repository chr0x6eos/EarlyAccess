<?php
    include "includes/session.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php include "includes/header.php"; ?>
    <body>
        <?php include "includes/menu.php"; ?>
        <div class="container fill">
            <div class="panel panel-default fill">
                <div class="panel-heading center"><h1>Game version v0.1.2.733</h1></div>
                    <div class="panel-body fill">
                        <div class="card header fill">
                            <div class="card-header center">
                                Play our innovative and immersive game
                            </div>
                            <div class="card-body fill">
                                <!-- https://www.educative.io/blog/javascript-snake-game-tutorial -->
                                <div class="h5 center" id="status">Click start to play!</div>
                                <div class="h1 center" id="score">0</div>
                                <br>
                                <div>
                                    <canvas id="snakeboard" width="400" height="400"></canvas>
                                    <style>
                                        #snakeboard {
                                            border: 1px solid blue;
                                            padding: 0;
                                            margin: auto;
                                            display: block;
                                            position: absolute;
                                            top: 0;
                                            bottom: 0;
                                            left: 0;
                                            right: 0;
                                        }
                                        .play {
                                            text-align: center;
                                            position: relative;
                                            margin-bottom: 1px;
                                            bottom: -70%;
                                        }
                                        .play-btn {
                                            width: 50%;
                                        }
                                    </style>
                                    <script src="assets/js/game.js"></script>
                                </div>
                                <div class="play">
                                    <button id="btn" class="btn btn-outline-dark center play-btn" onclick="start()">Play</button>
                                    <br>
                                    <?php include "includes/error.php"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                  
    </body>
</html>