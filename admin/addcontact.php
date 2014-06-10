<?php require('../includes/config.php'); 
 
if(isset($_POST['submit'])){
	$nume = $_POST['nume'];
	$prenume = $_POST['prenume'];
	$email = $_POST['email'];
	$telefon = $_POST['telefon'];
	$oras = $_POST['oras'];
	$adresa = $_POST['adresa'];
	$hobby= $_POST['hobby'];
	$picture = $_FILES['picture'];
 	$id_user = $_SESSION['id_user'];
	
	$nume = mysql_real_escape_string($nume);
	$prenume = mysql_real_escape_string($prenume);
	$email = mysql_real_escape_string($email);
	$telefon = mysql_real_escape_string($telefon);
	$oras = mysql_real_escape_string($oras);
	$adresa = mysql_real_escape_string($adresa);
	$hobby = mysql_real_escape_string($hobby);
 

 	$allowedMimeTypes = array( 
	'application/msword',
	'text/pdf',
	'image/gif',
	'image/jpeg',
	'image/png',
	'text/plain'
	);

 	$temp = explode(".", $_FILES["picture"]["name"]);
	$extension = end($temp);

 

 	if (!empty($nume && $prenume && $email && $telefon && $oras && $adresa && $hobby)){
		if(verif_contact($_POST['telefon'])==1){
			/*if ( in_array( $_FILES["picture"]["type"], $allowedMimeTypes ) ) 
			{  
			    $picture = $_FILES["picture"]["name"];
			    $filePath = $BASE_URL."assets/images/".$picture;    
			   // print_r($filePath); die;
			   
				if (move_uploaded_file($_FILES['picture']['tmp_name'], $filePath)) {
				    echo "Uploaded";
				*/
				 	mysql_query("INSERT INTO contacts (nume,prenume,email,telefon,oras,adresa,hobby,picture,id_user) VALUES ('$nume','$prenume','$email','$telefon','$oras','$adresa','$hobby' '$picture','$id_user')")or die(mysql_error());
					$_SESSION['success'] = 'Contact adaugat cu succes!';
					header('Location: '.$BASE_URL.'admin');
					exit(); 
				}else{
					$_SESSION['error'] = "Numarul este deja in baza de date!";
				}
			}else{
					$_SESSION['error'] = "Toate campurile sunt obligatorii!";
				}/*
			} else {
				   $_SESSION['error'] ="File was not uploaded";
				}
	 }*/
		
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
		</ul>
	</section> <!-- end sidebar -->
	<section class="container">
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
			<h1>Add Contact</h1>
			<div class="add-contact">
				<p><?php echo messages();?></p> 
			    <form method="post" action="" enctype="multipart/form-data">
			    	<fieldset name="user_data">
			    		 
				    	<label for="nume">Nume</label>
					    	<input type="text" name="nume"/><br />
					    <label for="prenume">Prenume</label>
					   	    <input type="text" name="prenume"/><br />
					    <label for="email">Email</label>
					     	<input type="text" name="email"/><br />
					    <label for="telefon">Telefon</label>
					    	<input type="text" name="telefon"/><br />
					    <label for="oras">Oras</label>
					    	<input type="text" name="oras"/><br />
					    <label for="adresa">Adresa</label>
					    	<input type="text" name="adresa"/><br />
					    <label for="hobby">Hobby</label>
					    	<input type="text" name="hobby"/><br />
				    </fieldset>
				    <fieldset name="upload">
				  
					    <label for="picture">Picture</label>
					    	<input type="file" name="picture"/><br />
					    	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
					 </fieldset>   
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