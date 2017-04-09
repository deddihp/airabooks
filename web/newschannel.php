<?php
	session_start();
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$rpop = new RandomPopular;
?>
<html>
	<head>
		<title>News Channel</title>
		<? 
			$desc = "airabooks News Channel";
			if ( $_GET['refdate'] != '' ) {
				$result = getNewsChannel($_GET['refdate']);
				$row = mysqli_fetch_array($result);
				$desc = $row['title'];
			}
		?>
		<?
			$description = $desc;
			echo writeMetaInfo($description);
		?>

		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="News Channel"/>
		<meta property="og:site_name" content="airabooks.com"/>
		<meta property="og:image" content="http://airabooks.com/images/airabooks.png"/>
		<meta property="og:description" content="<?echo $desc;?>"/>
	
		<?php
			echo $mlayout->writeHeadParameter();
		?>
	</head>
	<body>
	
	<?
		$header = $mlayout->writeHeader();
	?>
	
	<?
		$menu = $mlayout->writeMenu('News Channel', $_GET['refdate'], "", "./");
		$refdate = $_GET['refdate'];
	?>
	<?
		$mcontent = 
		"<div class=\"mcontent\" id=\"mcontent\">
			<div class=\"boxlong_detail\">
			<p class=\"left\">News Channel</p>";
				
				$result = getNewsChannel($_GET['refdate']);
				while ( $row = mysqli_fetch_array($result) ) {
					$mcontent = $mcontent . "<div style=\"display:table;
						width:100%;
						text-align:center;
						border:0px solid black;
						padding:5px 10px 5px 10px;
						margin: 0 0 1px 0;\">
					<div style=\"font:normal 13px/18px arial, sans-serif;
						border:1px solid #e2e2e2;
						text-align:left;
						padding:5px;
						margin: 0 0 1px 0;
						background-color:#f1f1f1;
					\">";
					$mcontent = $mcontent . "<p style=\"display:table; width:100%;
						font-weight:normal;font-size:12px;margin:1px;\">".
						$row['date']
						."</p>";
						if ( $refdate == '' ) {
							$mcontent = $mcontent . "<p style=\"display:table; width:860px;
								font-weight:bold;margin:0px;
								background-color:#b9cede;
								padding:5px 5px 5px 5px;
								\"><a href=newschannel.php?refdate=".urlencode($row['date']).">".
									$row['title']
								."</a></p>";
						} else {
							$mcontent = $mcontent . "<p style=\"display:table; width:860px;
								font-weight:bold;margin:0px;
								background-color:#b9cede;
								padding:5px;
								\">".
									$row['title']
								."</p>";
						}
					if ( $refdate == '' ) {
					$mcontent = $mcontent . "<p style=\"
							margin:5px;
							text-align:justified;
						\">".
						substr($row['content'], 0, 120) 
						."...<a href=newschannel.php?refdate=".urlencode($row['date']).">see more</a></p>";
					} else {
						$mcontent = $mcontent . "<p style=\"
							margin:5px;
							text-align:justified;
						\">".
						$row['content'] 
						."</p>";
						$mcontent = $mcontent . "<div style=\"margin:0 0 0 0px;text-align:center\">".
							writeCommentFB("http://airabooks.com/newschannel.php?date=".urlencode($row['date'])).
							"</div>";
					}
					$mcontent = $mcontent . "</div>";
					$mcontent = $mcontent . "</div>";
				}
			
			$mcontent = $mcontent . "</div></div>"
		?>
		<?
			echo printBasicLayout($mlayout, $header, $menu, $mcontent);
		?>
	</body>
</html>
