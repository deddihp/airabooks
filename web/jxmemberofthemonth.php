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
	$memberlayout = new MemberLayout;
?>
<html>
	<head>
	<?
		echo $mlayout->writeHeadParameter();
	?>
	</head>
	<body>
		
		<?
			echo $mlayout->writeBodyHeader();
			$month = $_GET['month'];
			$year = $_GET['year'];
			if ( $month == "" )
				$month = date('m');
			if ( $year == "" )
				$year = date('Y');
			echo $memberlayout->writeJXMemberOfTheMonth($month, $year, $mlayout,
				"Member Of The Month (Bulan ".MonthToIndo($month-1)." ".$year.")", "memberofthemonth.php", $subscriber_id_list);
		
			echo "
			<div style=\"display:none\">
			JSON-DATA";
			for ( $i = 0; $i < count($subscriber_id_list); $i++ ) {
				echo $subscriber_id_list[$i].",";
			}
			//echo writeJXSubscriberGroup($subscriber_id_list);
			echo "JSON-DATA_END
			</div>";
		?>
		</div>
	</body>
</html>
