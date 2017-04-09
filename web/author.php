<?
class Author {
	/* Member variables */
	var $author_name;
	var $nationality;
	var $info;
	var $rating;

	//constructor
	function __construct() {
	}
	function __destruct() {
	}

	function insertAuthor($author_name, $nationality, $info, $rating) {
		
	}
	function selectAuthor($offset, $num_rows) {

		$con = mysqli_connect("localhost", "root", "123123", "comic");
		//Check Connection
		if ( mysqli_connect_errno() ) {
			echo "Failed to connect MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con, "SELECT * FROM author");
		//while ( $row = mysqli_fetch_array($result) ) {
		//	echo $row['author_name'] . " " . $row['nationality'] . " " . $row['rating'];
		//	echo "<br />";
		//}
		mysqli_close($con);
		return $result;
	}

	function showHTML() {
		echo "
		<p class=\"h2\">Author</p>
							<table>
								<tr align=center>
									<td>
									<div class=\"tname\">Nama</div>
									</td>
									<td>
										<div class=\"tname\">Kebangsaan</div>
									</td>
									<td>
										<div class=\"tname\">Rating</div>
									</td>
								</tr>";
								//$author = new Author();
								$result = $this->selectAuthor(0,0);
								while ( $row = mysqli_fetch_array($result) ) {
									echo "<tr align=left>";
									echo "<td><div class=\"cname\">".$row['author_name']."</td>";
									echo "<td><div class=\"cname\">".$row['nationality']."</td>";
									echo "<td><div class=\"cname\">".$row['rating']."</td>";
									echo "</tr>";
								}
							echo "</table>";
	}
}
?>
