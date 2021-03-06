<?php require('../includes/config.php'); 
 
//daca utillizatorul nu este logat va fi redirectionat catre pagina de login
login_required();
 
//if logout has been clicked run the logout function which will destroy any active sessions and redirect to the login page
if(isset($_GET['logout'])){
	logout();
}
 
//run if a page deletion has been requested
if(isset($_GET['delpage'])){
		
	$delpage = $_GET['delpage'];
	$delpage = mysql_real_escape_string($delpage);
	$sql = mysql_query("DELETE FROM contacts WHERE id_contact = '$delpage'");
    $_SESSION['success'] = "Contact sters"; 
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

	<script language="JavaScript" type="text/javascript">
	function delpage(id)
	{
	   if (confirm("Sunteti sigur ca doriti sa stergeti contactul ?"))
	   {
		  window.location.href = '<?php print $BASE_URL;?>admin?delpage=' + id;
	   }
	}
</script>
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
		<?php 
		 
			//show any messages if there are any.
			messages();
			$id_user = $_SESSION['id_user']; 
			$data = mysql_query("SELECT * FROM contacts WHERE id_user=$id_user ORDER BY id_contact");

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
						echo"<p>Adresa : $row->adresa</p>";
						echo"<p>Hobby : $row->hobby</p>";
					echo"</a>";
				echo"</div> <!-- contact-element -->";
			
			}
		?>
		</div> <!-- end sub-container -->
	</section> <!-- end container -->
</section> <!-- end main-content -->


</body>
</html>