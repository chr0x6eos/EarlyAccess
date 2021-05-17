<?php
    include_once "includes/session.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php include_once "includes/header.php"; ?>
    <body>
        <?php include_once "includes/menu.php"; ?>
        <div class="container fill">
            <div class="panel panel-default fill">
                <div class="panel-heading center"><h1>Welcome admin!</h1></div>
                    <div class="panel-body center">
                        <?php
							if(isset($_GET['tool'])) {
								if($_GET['tool'] === "hashing")
									include_once "hashing.php";
								elseif($_GET['tool'] === "file")
                                {
                                    echo '<div class="card header">
                                    <div class="card-header">
                                        File-Tools
                                    </div>
                                    <div class="card-body center">
                                    <h3>UI not implemented yet!</h3>';
                                }
							}
                            include_once "includes/error.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>