<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE;?></title>
<link href="<?php print $BASE_URL;?>assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
 
	<div id="logo"><a href="<?php print $BASE_URL;?>"><img src="images/logo.png" alt="<?php echo SITETITLE;?>" title="<?php echo SITETITLE;?>" border="0" /></a></div><!-- close logo -->
	
	
	<div id="content">
	
	 <?php require_once('includes/config.php'); 
		if(!logged_in()) {header('Location: '.$BASE_URL.'admin/login.php');}
	?>
	
	</div><!-- close content div -->
 
	<div id="footer">	
			<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
	</div><!-- close footer -->
</div><!-- close wrapper -->
 
</body>
</html>