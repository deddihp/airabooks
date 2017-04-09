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
	$bookscommon = new BooksCommon;
	$bookslayout = new BooksLayout;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			echo $mlayout->writeHeadParameter();
		?>
		
		<title>Books Of The Month</title>
		<?
			$description = "Books Of The Month, Buku Bulan Ini";
			echo writeMetaInfo($description);
		?>
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="<? echo $description;?>"/>
		<meta property="og:site_name" content="www.airabooks.com"/>
		<meta property="og:description" content="<? echo $description; ?>"/> 
		

		<script>
			function jxReload(month, year) {
				var xmlhttp;
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function()
  					{
  						if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						//console.log('ok');
							document.getElementById('booksofthemonth').innerHTML = xmlhttp.responseText;
							var height = $('#mcontent').height();
							if ( $('#mcontent').height() < $('#mmenu').height() ) {
							height = $('#mmenu').height();
				} 
							document.getElementById('mfooter').style.top = height+"px";
							document.getElementById('maincontent').style.height = height+"px";
				
						}
  					}
				xmlhttp.open("GET",'jxbooksofthemonth.php?month='+month+'&year='+year,true);
				res = xmlhttp.send();
				//console.log(xmlhttp.responseHtml);
			}
		</script>
	</head>
	<body>
		<?
			$header = $mlayout->writeHeader();
		?>
		<?
			$menu = $mlayout->writeMenu("Books Of The Month", "");
		?>
		<?
			$month = $_GET['month'];
			$year = $_GET['year'];
			if ( $month == "" )
				$month = date('m');
			if ( $year == "" )
				$year = date('Y');
			$mcontent = $bookslayout->writeBooksOfTheMonth($month, $year, $mlayout, $bookscommon,
				"Books Of The Month (Bulan ".MonthToIndo((int)$month-1)." ".$year.")", "", "booksofthemonth.php");
		?>
		<?
			echo printBasicLayout($mlayout, $header, $menu, $mcontent);
		?>
	</body>
</html>
