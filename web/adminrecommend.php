<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}
	if ( $fb->userstatus != 'ADMIN' ) {
		echo "Anda harus admin";
		exit;
	}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<script type="text/javascript" src="jquery.min.js"></script> 
	<? echo $fb->writeJSCaptureLike(); ?>
	
</head>
<body>
	<? echo $fb->writeFBJSHeader(); ?>	
	
	<div class="header">
		<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Admin', $fb);
			$layout->showAdminMenu('Admin Recommend', $fb);
		?>
	</div>
	<?php
		include 'book.php';
	?>			
	<div class="body">
		<div>
			<div class="filter">
				<?
					include 'rent.php';
					$rhist = new AdminRecommend();
					$rhist->showFilter($_GET['subsid']);	
				?>
				<!-- For Filter -->
			</div>
		</div>
	</div>
	<div class="body">
		<div class="forcontent">
			<div>
				<div>
					<div class="section">
						<form name="adminrecom" method="GET" action="adminrecommend.php">
							<input type="text" name="subsid" value="">
							<input type="submit" name="submit">
						</form>
						<?
							echo "SubscriberID = ".$_GET['subsid'];
							//$booktitle->showHTML();
							$rhist->showAdminRecomm($fb, $_GET['subsid']);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
			$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
