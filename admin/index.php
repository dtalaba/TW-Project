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
	<title>Onco</title>

	<link rel="stylesheet" type="text/css" href="<?php print $BASE_URL;?>assets/css/style.css">

	<script language="JavaScript" type="text/javascript">
	function delpage(id, $row->name;)
	{
	   if (confirm("Are you sure you want to delete '" + $row->name + "'"))
	   {
		  window.location.href = '<?php print $BASE_URL;?>admin?delpage';
	   }
	}
</script>
</head>
<body>

<section class="main-content">
	<section class="sidebar">
		<h1>ONCO</h1>
		<div class="user">
			<div class="user-img">
				<img src="<?php print $BASE_URL;?>assets/images/no-pic-avatar.png" alt="" />
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
		<?php 
			$i=1;
			//show any messages if there are any.
			messages();
			 
			$sql = mysql_query("SELECT * FROM contacts ORDER BY id_contact");

			while($row = mysql_fetch_object($sql)) 
			{

					echo "<div class='contact-element'>";
						echo "<a href=delpage('$row->id_contact','$row->nume');><button class='delete'>X</button></a>";
						echo "<a href='editcontact.php?id=$row->id_contact'>";
							echo "<h2>$row->nume $row->prenume</h2>";
							echo"<img src='<?php print $BASE_URL;?>assets/images/$row->picture' alt='' />";
							//echo"<p>Nume : $row->nume</p>";
							//echo"<p>Prenume : $row->prenume</p>";
							echo"<p>Email : $row->email</p>";
							echo"<p>Telefon : $row->telefon</p>";
						echo"</a>";
					echo"</div> <!-- contact-element -->";
			
			}
		?>
		</div> <!-- end sub-container -->
	</section> <!-- end container -->
</section> <!-- end main-content -->


</body>
</html>