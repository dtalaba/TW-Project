<?php require('../includes/config.php'); 
	  include('../includes/export.php');
 
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
			<h1>Export</h1>
			<div class="add-contact">
				<?php
			    $query = mysql_query("SELECT * FROM contacts");
				 
				

				/*echo '<pre>';
				print_r($data);
				echo '</pre>';
				$export = new H_Mysql_Export();
				$export->headerAry = array('Nume','Prenume','Email','Telefon');	// TABLE COLUMN NAMES
				$export->dataAry = $data;					// TABLE DATA ARRAY FROM MYSQL
				$export->filename = 'CSV';					// CUSTOM FILE NAME 
				$export->directory = 'localhost/tw/proiect/files/';					// DIRECTORY NAME
				$export->csv(); 				 
				*/

				// Pick a filename and destination directory for the file
				// Remember that the folder where you want to write the file has to be writable
				$filename = "http://localhost/tw/proiect/files/db_user_export_".time().".csv";
				 
				// Actually create the file
				// The w+ parameter will wipe out and overwrite any existing file with the same name
				$handle = fopen($filename, 'w+');
				 
				// Write the spreadsheet column titles / labels
				fputcsv($handle, array('Username','Email'));
				 
				// Write all the user records to the spreadsheet
				foreach($query as $row)
				{
				    fputcsv($handle, array($row['username'], $row['email']));
				}
				 
				// Finish writing the file
				fclose($handle);
 	 
				?>
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