<!DOCTYPE html>
<?php
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
<html>
	<head>
	</head>
	<body>
		
		<?
			$month = $_GET['month'];
			$year = $_GET['year'];
			if ( $month == "" )
				$month = date('m');
			if ( $year == "" )
				$year = date('Y');
			echo $bookslayout->writeJXBooksOfTheMonth($month, $year, $mlayout, $bookscommon,
				"Books Of The Month (Bulan ".MonthToIndo($month-1)." ".$year.")", "", "booksofthemonth.php");
		?>
		</div>
	</body>
</html>
