<?php
 
if (!defined('included')){
die('Nu ai acces la acest fisier!');
}
 
//log user in 

function login($user, $pass){
 
   //strip all tags from varible   
   $user = strip_tags(mysql_real_escape_string($user));
   $pass = strip_tags(mysql_real_escape_string($pass));
   //criptare md5 parola
   $pass = md5($pass);
 
   // check if the user id and password combination exist in database
   $sql = "SELECT * FROM members WHERE username = '$user' AND password = '$pass'";
   $result = mysql_query($sql) or die('A aparut o eroare la interogare: ' . mysql_error());
      
   if (mysql_num_rows($result) == 1) {
      // daca username si parola is ok se seteaza sesiunea
	  $_SESSION['authorized'] = true;
					  
	  // direct catre admin
      header('Location: '.$BASE_URL.'admin');
	  exit();
   } else {
	// eroare
	$_SESSION['error'] = 'Ai introdus parola sau username gresit !';
   }
}
 
// autentificare
function logged_in() {
	if($_SESSION['authorized'] == true){
		return true;
	} else {
		return false;
	}	
}
//trebuie sa fii logat ca sa te conectezi
function login_required() {
	if(logged_in()) {	
		return true;
	} else {
		header('Location: '.$BASE_URL.'login.php');
		exit();
	}	
}
//functie logout
function logout(){
	unset($_SESSION['authorized']);
	header('Location: '.$BASE_URL.'login.php');
	exit();
}
 
// afisarea erorilor
function messages() {
    $message = '';
    if($_SESSION['success'] != '') {
        $message = '<div class="msg-ok">'.$_SESSION['success'].'</div>';
        $_SESSION['success'] = '';
    }
    if($_SESSION['error'] != '') {
        $message = '<div class="msg-error">'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = '';
    }
    echo "$message";
}
 
function errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
			$showError.= "<div class='msg-error'>".$error[$i]."</div>";
			$i ++;}
			echo $showError;
	}
} 

function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }

     }

 
?>