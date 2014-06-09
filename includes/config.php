<?php
ob_start();
session_start();
 
// db properties
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','tw');
 
// make a connection to mysql here
$conn = @mysql_connect (DBHOST, DBUSER, DBPASS);
$conn = @mysql_select_db (DBNAME);
if(!$conn){
	die( "Ne pare rau dar nu v-ati putut conecta la baza noastra de date !");
}
 
$BASE_URL = 'http://localhost/tw/proiect/';
 
// define site title for top of the browser
define('SITETITLE','Onco');
 
//define include checker
define('included', 1);
 
include('functions.php');
?>