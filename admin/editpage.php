<?php require('../includes/config.php'); 
 
if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.$BASE_URL.'admin/editpage.php');
}
 
if(isset($_POST['submit'])){
 
	$nume = $_POST['nume'];
	$prenume = $_POST['prenume'];
	$email = $_POST['email'];
	$telefon = $_POST['telefon'];
	$picture = $_POST['picture'];
	$id_contact = $_POST['id_contact'];
	
	$nume = mysql_real_escape_string($nume);
	$prenume = mysql_real_escape_string($prenume);
	$email = mysql_real_escape_string($email);
	$telefon = mysql_real_escape_string($telefon);
	$picture = mysql_real_escape_string($picture);
	
	mysql_query("UPDATE contacts SET nume='$nume', prenume='$prenume', email='$email', telefon='$telefon', picture='$picture' WHERE id_contact='$id_contact'");
	$_SESSION['success'] = 'Contact updatat cu succes !';
	header('Location: '.$BASE_URL.'admin');
	exit();
 
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE;?></title>
<link href="<?php print $BASE_URL;?>assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
 
<div id="logo"><a href="<?php print $BASE_URL;?>admin>"><img src="images/logo.png" alt="<?php echo SITETITLE;?>" title="<?php echo SITETITLE;?>" border="0" /></a></div><!-- close logo -->
 
<!-- NAV -->
<div id="navigation">
<ul class="menu">
<li><a href="<?php print $BASE_URL;?>admin">Admin</a></li>
<li><a href="<?php print $BASE_URL;?>admin/>logout">Logout</a></li>
<li><a href="<?php print $BASE_URL;?>" target="_blank">View Website</a></li>
</ul>
</div>
<!-- END NAV -->
 
<section class="container">
	<h1>Edit Page</h1>
 
	<?php
	$id_contact = $_GET['id_contact'];
	$id_contact = mysql_real_escape_string($id);
	$q = mysql_query("SELECT * FROM contacts WHERE id_contact='$id_contact'");
	$row = mysql_fetch_object($q);
	?>
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
			    	<input type="text" name="nume" value="<?php echo $row->nume; ?>" />
			    <label for="prenume">Prenume</label>
			   	    <input type="text" name="prenume" value="<?php echo $row->prenume;?>" />
			    <label for="email">Email</label>
			     	<input type="text" name="email" value="<?php echo $row->email;?>" />
			    <label for="telefon">Telefon</label>
			    	<input type="text" name="telefon" value="<?php echo $row->telefon;?>" />
			    <label for="picture">Picture</label>
			    	<input type="file" name="picture"/>
	     		<p class="submit"><input type="submit" name="commit" value="Add"></p>
		    </form>
		</div> <!-- end add-contact -->

	</div> <!-- end sub-container -->
</section> <!-- end container -->
 
<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->
 
</body>
</html>