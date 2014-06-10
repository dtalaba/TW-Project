<?php require('../includes/config.php'); 
if(logged_in()) {header('Location: '.$BASE_URL.'admin');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITETITLE;?></title>
<link rel="stylesheet" href="<?php print $BASE_URL;?>assets/css/style.css" type="text/css" />
</head>
<body>
<sectio>
		<?php 
		if(isset($_POST['submit'])) {
			login($_POST['username'], $_POST['password']);
		}
		?>
	 
		<div class="login-wrapper">
			<p><?php echo messages();?></p>  
			<div class="content box">
				<h1>Log in</h1>
				<form action="" method="post" id="login">
					<label for="username">User:</label>
					<input type="text" name="username" id="username" class="box" placeholder="dan@yahoo.com"/>
					<label for="password">Parola:</label>
					<input type="password" name="password" id="password" class="box" placeholder="****************"/>
					<p class="remember-username">
						<input type="checkbox" name="remember-me" id="remember-me">
						<label for="remember-me">Tine-ma minte !</label>
					</p>
					<button type="submit" name="submit">Login</button>
				</form>
				<hr>
				<p class="footer-links signup">N-ai cont? <a href="singup.php">Inregistreaza-te!</a></p>
			</div>
		</div>
			
	 
		<div class="clear"></div>		
<div class="footer">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>	
</section>
</body>
</html>