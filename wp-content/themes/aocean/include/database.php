<?php
if (file_exists( dirname( __FILE__ ) . '/database_local.php' ) ) {
	include( dirname( __FILE__ ) . '/database_local.php' );
}
else {
	function getConnectionDB () {
		$user = 'opad2016';
		$pass = 'opad2016';
		$opt = array(
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		);
		$dbh = new PDO('mysql:host=localhost; dbname=opad', $user, $pass, $opt);
		$sql = "ALTER TABLE  `Stats` CHANGE  `Password`  `Password` VARCHAR( 255 ) NULL DEFAULT NULL";
		$dbh->exec($sql);
		$sql = "ALTER TABLE  `Stats` CHANGE  `Email` `Email` VARCHAR( 255 ) NULL DEFAULT NULL ";
		$dbh->exec($sql);
		return $dbh;
	}
}