<?php
include 'mysql_comic.php';
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	/*if (	(($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/jpg")
					|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 20000)
			&& in_array($extension, $allowedExts))
  	*/
	{
  		if ($_FILES["file"]["error"] > 0)
    	{
    		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    		exit;
		}
  		else
    	{
    		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    		echo "Type: " . $_FILES["file"]["type"] . "<br>";
    		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    		if (file_exists("cover/".$_POST['title'].".jpg"))//"upload/" . $_FILES["file"]["name"]))
      		{
      			echo $_FILES["file"]["name"] . " already exists. ";
      			exit;
			}
    		//else
      		{
      			move_uploaded_file($_FILES["file"]["tmp_name"],
      			"cover/".$_POST['title'].".jpg");
				//"upload/" . $_FILES["file"]["name"]);
      			echo "<br>Stored in: " . "cover/" . $_POST['title'].".jpg";//$_FILES["file"]["name"];
      		}
    	}
  	}
	//else
  	//{
  	//	echo "Invalid file";
  	//}

	
	if(isset($_POST['title']))  
	{
    	echo "<br>Judul = ".$_POST['title'];
		echo "<br>";
	}
	else
	{
		echo "<br>ERROR: Cannot find title<br>";
		exit;
	}
	$type = $_POST['type'];
	$date = $_POST['thisdate'];
	$title = $type." ".$date; 
	$article = $_POST['article'];
	if ( $type == "New Release" )
		$link = "newrelease.php?refdate=".$date;
	else if ( $type == "Coming Soon" )
		$link = "comingsoon.php?title=".$title;
	
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "INSERT INTO newsevent values('NOW()','".$title."','".
							$article."','".$link."')";
	
	echo "<br>query = ".$query;
	$result = $mysql->query($query);
	echo "<br><br>RESULT = ";
	var_dump($result);
	echo "Upload SUKSES";
	sleep(2);
	header('Location: nr_cs.php');
?>
