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
							<svg width="64" viewBox="0 0 48 48" fill="none">
								<path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"></path>
								<path d="M14.134 45.885A23. 914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"></path>
							</svg>
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
