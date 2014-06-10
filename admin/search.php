<?php require('../includes/config.php'); 
 
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
			
			<?php 
			 //This is only displayed if they have submitted the form 
			 if ($_POST['searching'] =="yes") 
			 { 
			 echo "<h1>Rezultatele cautarii :</h1>"; 
			 
			 //If they did not enter a search term we give them an error 
			 if ($_POST['find'] == "") 
			 { 
			 echo "<p>Nu ai introdus nici un contact !</p>"; 
			 exit; 
			 } 
			 
			 
			 $find=$_POST['find'];
			 $field=$_POST['field'];
			 //print_r($field);die;
			 $find = strtoupper($find); 
			 $find = strip_tags($find); 
			 $find = trim ($find); 
			 //print_r($find);die;
			 //Now we search for our search term, in the field the user specified 
			 $data = mysql_query("SELECT * FROM contacts WHERE $field LIKE'%$find%'"); 
			 
			 while($row = mysql_fetch_object($data)) 
			{

					echo "<div class='contact-element'>";
						echo "<a href=javascript:delpage('$row->id_contact');><button class='delete'>X</button></a>";
						echo "<a href='editcontact.php?id=$row->id_contact'>";
							echo "<h2>$row->nume $row->prenume</h2>";
							echo"<img src='http://localhost/tw/proiect/assets/images/$row->picture' alt='' />";
							//echo"<p>Nume : $row->nume</p>";
							//echo"<p>Prenume : $row->prenume</p>";
							echo"<p>Email : $row->email</p>";
							echo"<p>Telefon : $row->telefon</p>";
						echo"</a>";
					echo"</div> <!-- contact-element -->";
			
			}
			 
			 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
			 $anymatches=mysql_num_rows($data); 
			 if ($anymatches == 0) 
			 { 
			 echo "Ne pare rau dar nu am gasit nici o potrivire in baza de date :)."; 
			 } 
			 
			 //And we remind them what they searched for 
			 echo "<br /><b>Ai cautat dupa:</b> " .$find; 
			 } 
			 ?> 
						    


		</div> <!-- end sub-container -->
	</section> <!-- end container -->
</section> <!-- end main-content -->  
<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->
 
</body>
</html>