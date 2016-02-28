<?php

date_default_timezone_set('UTC');
$ip_addr = $_SERVER['REMOTE_ADDR'];

if( isset($_SERVER['HTTP_X_FORWARD_FOR']) ) {
	$ip_addr = $_SERVER['HTTP_X_FORWARD_FOR'];
}

// database conf
$db_host = "localhost";
$db_name = 'edunet';
$db_user = 'root';
$db_pass = '';

// site configs
$webpath = '/';
$webroot = 'https://' . filter_input(INPUT_SERVER, 'HTTP_HOST'); 
$webhost = $webroot . $webpath;

try {
  $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $ex) {
  echo $ex->getMessage();
  exit;
}

function esc($data) {
	$encoded = '';
	$length  = mb_strlen($data);

	for($i=0;$i<$length;$i++){
		$encoded .= '%' . wordwrap(bin2hex(mb_substr($data,$i,1)),2,'%',true);
	}

	return $encoded;
}