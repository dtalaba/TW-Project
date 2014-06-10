<?php require('../includes/config.php'); 
 
if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.$BASE_URL.'admin/editcontact.php');
}
 
if(isset($_POST['submit'])){
 
	$nume = $_POST['nume'];
	$prenume = $_POST['prenume'];
	$email = $_POST['email'];
	$telefon = $_POST['telefon'];
 
	$id_contact = $_POST['id_contact'];
	
	$nume = mysql_real_escape_string($nume);
	$prenume = mysql_real_escape_string($prenume);
	$email = mysql_real_escape_string($email);
	$telefon = mysql_real_escape_string($telefon);
 
	
	mysql_query("UPDATE contacts SET nume='$nume', prenume='$prenume', email='$email', telefon='$telefon', picture='$picture' WHERE id_contact='$id_contact'");
	$_SESSION['success'] = 'Contact updatat cu succes !';
	header('Location: '.$BASE_URL.'admin');
	exit();
 
}
 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo SITETITLE;?></title>

	<link rel="stylesheet" type="text/css" href="<?php print $BASE_URL;?>assets/css/style.css">
 
</head>
<body>

<section class="main-content">
	<section class="sidebar">
		<h1><?php echo SITETITLE;?></h1>
		<div class="user">
			<div class="user-img">
				<img src="<?php print $BASE_URL;?>assets/images/no-pic-avatar.png" alt="" />
			</div> <!-- user-img -->
			<div class="user-details">
				<p>Welcome, </p>
				<span><?php
				if(isset($_SESSION['username'])) print $_SESSION['username'];
				//if(isset($_SESSION['id_user'])) print $_SESSION['id_user'];

				?></span>
				<a href="<?php print $BASE_URL;?>admin?logout">Logout</a>
			</div> <!-- end user-details -->
		</div> <!-- end user -->

		<ul>
			<li><a href="<?php print $BASE_URL;?>admin/">Home</a></li>
			<li><a href="<?php print $BASE_URL;?>admin/addcontact.php">Add Contact</a></li>
			<li><a href="<?php print $BASE_URL;?>admin/export.php">Export</a></li>
	</section> <!-- end sidebar -->
	<section class="container">
		
		<?php
		$id = $_GET['id'];
		$id = mysql_real_escape_string($id);
		$q = mysql_query("SELECT * FROM contacts WHERE id_contact='$id'");
		$row = mysql_fetch_object($q);

		?>
		<header>
			<form name="search" method="post" id="search" action="search.php">
				 <input type="text" name="find" placeholder="Cauta" /> in 
				 <select name="field" onchange="if (this.value) window.location.href=?this.value">
				 <option value="nume">Nume</option>
				 <option value="prenume">Prenume</option>
				 <option value="telefon">Telefon</option>
				 </select>
				 <input type="hidden" name="searching" value="yes" />
				 <input type="submit" name="search" value="Search" />
			</form>
		</header>
		<div class="sub-container">
			<h1>Edit Page</h1>
			<div class="add-contact">
			    <form method="post" action="">
			    	<label for="nume">Nume</label>
				    	<input type="text" name="nume" value="<?php echo $row->nume; ?>" /><br />
				    <label for="prenume">Prenume</label>
				   	    <input type="text" name="prenume" value="<?php echo $row->prenume;?>" /><br />
				    <label for="email">Email</label>
				     	<input type="text" name="email" value="<?php echo $row->email;?>" /><br />
				    <label for="telefon">Telefon</label>
				    	<input type="text" name="telefon" value="<?php echo $row->telefon;?>" /><br />
				    <label for="picture">Picture</label>
				    	<input type="file" name="picture"/><br />
				    	<input type="hidden" name="id_contact" value="<?php echo $row->id_contact;?>" />
		     		<p class="submit"><input type="submit" name="submit" value="Editeaza contact"></p>
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