<?php require('../includes/config.php'); 
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];

	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$email = mysql_real_escape_string($email);

	if(singup($_POST['username'])==1){

		mysql_query("INSERT INTO users (username,password,email) VALUES ('$username','$password','$email')")or die(mysql_error());
			$_SESSION['success'] = 'Te-ai inregistrat cu succes!';
			header('Location: '.$BASE_URL.'admin');
			exit();
	}else{
		$_SESSION['error'] = "A aparut o eroare la validarea campurilor!";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITETITLE;?></title>
<link rel="stylesheet" href="<?php print $BASE_URL;?>assets/css/style.css" type="text/css" />

<script language="JavaScript" type="text/javascript">
function validateForm() {
	//verificare username
    var x = document.forms["Formular"]["username"].value;
    if (x==null || x=="" || x.length<3) {
        alert("Username gresit, cel putin 3 caractere !!!");
        return false;
	}
    //verificare password
    var x = document.forms["Formular"]["password"].value;
    if (x==null || x=="" || x.length<5) {
        alert("Parola nu este buna !!!");
        return false;
    }

    //verificare email
    x = document.forms["Formular"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Adresa email gresita !!!");
        return false;
    }
    }
</script>

</head>
<body>
<section>
	 
		<div class="login-wrapper">
			<p><?php echo messages();?></p>  
			<div class="content box">
				<h1>Sing up</h1>
				<form name="Formular" action="" onsubmit="return validateForm()" action="" method="post" id="singup">
					<label for="username">User:</label>
					<input type="text" name="username" id="username" class="box" placeholder="Utilizator"/>
					<label for="password">Parola:</label>
					<input type="password" name="password" id="password" class="box" placeholder="**********"/>
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" class="box" placeholder="dan@yahoo.com"/>
					<p class="remember-username"></p>
					<button type="submit" name="submit">Singup</button>
				</form>
				<hr>
				<p class="footer-links">Ai deja cont? <a href="login.php">Log in!</a></p>
			</div>
		</div>
			
	 
		<div class="clear"></div>		
<div class="footer">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>	
</section>
</body>
</html>