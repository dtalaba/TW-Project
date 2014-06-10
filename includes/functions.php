<?php
 
if (!defined('included')){
die('Nu ai acces la acest fisier!');
}
 
//log user in 

function login($user, $pass){
  $BASE_URL = 'http://localhost/tw/proiect/';
   //strip all tags from varible   
   $user = strip_tags(mysql_real_escape_string($user));
   $pass = strip_tags(mysql_real_escape_string($pass));
   //criptare md5 parola
   $pass = md5($pass);
 
   // check if the user id and password combination exist in database
   $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
   $result = mysql_query($sql) or die('A aparut o eroare la interogare: ' . mysql_error());
    $row = mysql_fetch_object($result);  
   if (mysql_num_rows($result) == 1) {
    // daca username si parola is ok se seteaza sesiunea
	  $_SESSION['authorized'] = true;
		$_SESSION['username'] = $user;	
    $_SESSION['id_user'] = $row->id;	  	  
	  // direct catre admin
    header('Location: '.$BASE_URL.'admin');
	  exit();
   } else {
	// eroare
	$_SESSION['error'] = 'Ai introdus parola sau username gresit !';
   }
}

function singup($user){
  
   $user = strip_tags(mysql_real_escape_string($user));
  

   $sql = "SELECT * FROM users WHERE username = '$user'";
   $result = mysql_query($sql) or die('A aparut o eroare la interogare: ' . mysql_error());
   $row = mysql_fetch_object($result);  
       if (mysql_num_rows($result) == 1) {
           $_SESSION['error'] = 'Userul este deja in baza de date !';
         }
         else {return 1;}    
}

 function verif_contact($telefon){
  
   $telefon = strip_tags(mysql_real_escape_string($telefon));

   $sql = "SELECT * FROM contacts WHERE telefon = '$telefon'";
   $result = mysql_query($sql) or die('A aparut o eroare la interogare: ' . mysql_error());
   $row = mysql_fetch_object($result);  
       if (mysql_num_rows($result) == 1) {
           $_SESSION['error'] = 'Contactul este deja in baza de date !';
         }
         else {return 1;}    
}
// autentificare
function logged_in() {
	if(isset($_SESSION['authorized']) == true){
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

function is_valid_type($file)
{
  // This is an array that holds all the valid image MIME types
  $valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/gif");

  if (in_array($file['type'], $valid_types))
    return 1;
  return 0;
}

function export_csv($results, $name = NULL){
  if(!$name)
    {
        $name = md5(uniqid() . microtime(TRUE) . mt_rand()). '.csv';
    }

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename='. $name);
    header('Pragma: no-cache');
    header("Expires: 0");

    $outstream = fopen("php://output", "w");

    foreach($results as $result)
    {
        fputcsv($outstream, $result);
    }

    fclose($outstream);
}

?>