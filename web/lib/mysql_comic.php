<?php

	$COMIC_DB="airabk00_comic";
	$COMIC_DBWEB="airabk00_comic_web";
	$MOVIE="airabk00_movie";
	$MYSQL_USER="airabk00_deddihp";
	$MYSQL_PASSWD="123123123";
	$MYSQL_IP="localhost";
/*	
	$COMIC_DB="comic";
	$COMIC_DBWEB="comic_web";
	$MYSQL_USER="root";
	$MYSQL_PASSWD="123123";
	$MYSQL_IP="localhost";	
*/

class MySQLComic {
	var $con;
	function __construct($dbname) {
		$this->con = mysqli_connect($GLOBALS['MYSQL_IP'], $GLOBALS['MYSQL_USER'], $GLOBALS['MYSQL_PASSWD'], $dbname);
		if ( !($this->con) ) {
			echo "DIE MYSQL Connect Error ".mysqli_connect_errno();
			echo "Failed to connect MySQL: " . mysqli_connect_error();
			echo "<br>QUERY failed: (" . $mysqli->errno . ") " . $mysqli->error;

		}
	}
	function __destruct() {
		mysqli_close($this->con);
	}

	function query($query) {
		$result = mysqli_query($this->con, $query);
		if ( !$result ){ 
			echo "DIE QUERY Query='".$query."'(".mysqli_connect_errno().")<br>";
			echo "Failed to do MySQL Query: " . mysqli_connect_error();
			echo "<br>QUERY failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		return $result;
	}
}
?>
