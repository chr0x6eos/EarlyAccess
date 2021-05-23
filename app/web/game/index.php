<?php
	include_once "includes/config.php";

	if(isset($_SESSION['user']))
		header('Location: /game.php');
?>
<!DOCTYPE html>
<html lang="en">
	<?php include_once "includes/header.php"; ?>
	<body class="bg-light font-sans antialiased">
		<div class="container">
    		<div class="row justify-content-center my-5">
        		<div class="col-sm-12 col-md-8 col-lg-5 my-4">
					<div>
                		<a class="d-flex justify-content-center mb-4" href="/">
							<img src="/assets/logo.png" width="366" height="205">
						</a>
            		</div>
					<div class="card shadow-sm px-1 mx-4">
						<div class="card-body">
							<h3>Welcome!</h3>
							<p>Please log in with your account that your EarlyAccess-Key is linked to.</p>
        	    			<form method="POST" action="/actions/login.php">
        	    			    <div class="form-group">
        	    			        <label>Email</label>
        	    			        <input class="form-control" type="email" name="email" required="required" autofocus>
								</div>
        	    			    <div class="form-group">
        	    			        <label>Password</label>
        	    			        <input class="form-control" type="password" name="password" required="required" autocomplete="current-password">
								</div>
							
        	    			    <div class="mb-2">
        	    			        <div class="d-flex justify-content-end align-items-baseline">
        	    			            <button type="submit" class="btn btn-dark text-uppercase">Log in</button>
        	    			        </div>
        	    			    </div>
        	    			</form>
							<?php include_once "includes/error.php"; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
