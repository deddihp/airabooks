<?php

	$COMIC_DB="comic";
	$COMIC_DBWEB="comic_web";
	$MYSQL_USER="deddihp";
	$MYSQL_PASSWD="comic_passwd";
	$MYSQL_IP="localhost";

class MySQLComic {
	var $con;
	function __construct($dbname) {
		$this->con = mysqli_connect($GLOBALS['MYSQL_IP'], $GLOBALS['MYSQL_USER'], $GLOBALS['MYSQL_PASSWD'], $dbname);
		if ( mysqli_connect_errno() ) {
			echo "Failed to connect MySQL: " . mysqli_connect_error();
		}
	}
	function __destruct() {
		mysqli_close($this->con);
	}

	function query($query) {
		$result = mysqli_query($this->con, $query);
		if ( mysqli_connect_errno() ) {
			echo "Failed to do MySQL Query: " . mysqli_connect_error();
		}
		return $result;
	}
}
?>
