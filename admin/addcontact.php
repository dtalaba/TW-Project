<?php require('../includes/config.php'); 
 
if(isset($_POST['submit'])){
 
	$nume = $_POST['nume'];
	$prenume = $_POST['prenume'];
	$email = $_POST['email'];
	$telefon = $_POST['telefon'];
 
	
	$nume = mysql_real_escape_string($nume);
	$prenume = mysql_real_escape_string($prenume);
	$email = mysql_real_escape_string($email);
	$telefon = mysql_real_escape_string($telefon);
	 

 	 

		 	mysql_query("INSERT INTO contacts (nume,prenume,email,telefon,picture) VALUES ('$nume','$prenume','$email','$telefon','target_path')")or die(mysql_error());
			$_SESSION['success'] = 'Contact adaugat cu succes!';
			header('Location: '.$BASE_URL.'admin');
			exit();
		 
	
 
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Onco</title>

	<link rel="stylesheet" type="text/css" href="<?php print $BASE_URL;?>assets/css/style.css">

	 
</head>
<body>

<section class="main-content">
	<section class="sidebar">
		<h1>ONCO</h1>
		<div class="user">
			<div class="user-img">
				<img src="assets/images/no-pic-avatar.png" alt="" />
			</div> <!-- user-img -->
			<div class="user-details">
				<p>Welcome, </p>
				<span>admin</span>
				<a href="<?php print $BASE_URL;?>admin?logout">Logout</a>
			</div> <!-- end user-details -->
		</div> <!-- end user -->

		<ul>
			<li><a href="<?php print $BASE_URL;?>admin/">Home</a></li>
			<li><a href="<?php print $BASE_URL;?>admin/addcontact.php">Add Contact</a></li>
		</ul>
	</section> <!-- end sidebar -->
	<section class="container">
		<header>
			<form method="get" action="/search" id="search">
			  	<input name="q" type="text" size="40" placeholder="Search..." />
			</form>
		</header>
		<div class="sub-container">
			<h1>Add Contact</h1>
			<div class="add-contact">
			    <form method="post" action="">
			    	<label for="nume">Nume</label>
				    	<input type="text" name="nume"/><br />
				    <label for="prenume">Prenume</label>
				   	    <input type="text" name="prenume"/><br />
				    <label for="email">Email</label>
				     	<input type="text" name="email"/><br />
				    <label for="telefon">Telefon</label>
				    	<input type="text" name="telefon"/><br />
				    <label for="picture">Picture</label>
				    	<input type="file" name="picture"/><br />
		     		<p class="submit"><input type="submit" name="submit" value="Add" /></p>
			    </form>
			</div> <!-- end add-contact -->

		</div> <!-- end sub-container -->
	</section> <!-- end container -->
</section> <!-- end main-content -->  
<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->
 
</body>
</html>