<?php
	session_start();
	/* Define All Class */
	include '../lib/layout.php';
	include '../lib/mysql_comic.php';
	include '../lib/book.php';
?>
<?php
	$mlayout = new MainLayout;
	$bookswiki = new BooksWiki;
?>
<!DOCTYPE html>
<html>
	<?
		$code = $_GET['bookcode'];
		$title = AdjustString(getBookTitle($_GET['bookcode']));
		$author = AdjustString(getBookAuthor($_GET['bookcode']));
		$wikistr = $bookswiki->writeWiki($_GET['bookcode'], $synopsis, $subscriber_id_list);
		$imgcover = "/cover_small/".$code.".jpg";
		if ( file_exists("../".$imgcover) == false ) {
			$imgcover = "http://airabooks.com/images/airabooks.png";
		} else
			$imgcover = "http://airabooks.com/".$imgcover;
		
		$synopsis = str_replace('\'','', $synopsis);
		$synopsis = str_replace('"', '', $synopsis);
		$synopsis = str_replace('\n', '', $synopsis);
	?>		
	<head>	
		<meta charset="UTF-8">
		<title><? echo $title; ?></title>
		<?
			$description = $title.", ".$synopsis;
			echo writeMetaInfo($description);
		?>
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="<? echo $title;?>"/>
		<meta property="og:site_name" content="www.airabooks.com"/>
		<meta property="og:image" content="<? echo $imgcover; ?>"/>
		<meta property="og:description" content="<? 
		if ( $synopsis == "Sinopsis Belum Tersedia" ) { 
			echo "Nikmati pengalaman baru meminjam buku di airabooks dan lihat Koleksi ".$title." di sini. Yang belum gabung dengan airabooks, Ayo bergabung, registrasi GRATIS Lho";
			$synopsis = "Nikmati pengalaman baru meminjam buku di airabooks dan lihat Koleksi ".$title." di sini. Yang belum gabung dengan airabooks, Ayo bergabung, registrasi GRATIS Lho";
			
		} else
			echo str_replace('"','\'',$synopsis); ?>"/>
		<meta property="og:url" content="http://airabooks.com/wiki/wikibook.php?bookcode=<? echo $code ?>"/>
	
		<?php
			echo $mlayout->writeHeadParameter('../');
		?>
		<?
			$str = 'http://airabooks.com/wiki/wikibook.php?bookcode='.$code;
			$synopsis = str_replace('\'','', $synopsis);
			$synopsis = str_replace('"', '', $synopsis);
			$synopsis = str_replace("\n", "X", $synopsis);
			$synopsis = str_replace("", "", $synopsis);
			//$synopsis = getSynopsisOnly('', $synopsis);
			echo writeJSShare($title,$str,$imgcover,'by '.$author,substr($synopsis, 0, 300).'...','');
			//echo writeJSShare($title, 'http://airabooks.com/wiki/wikibook.php?bookcode='.$code, $imgcover, $title, $synopsis, $title);
		?>


	</head>
	<body>
		<?
			$header = $mlayout->writeHeader('../');
		?>
		<?
			$menu = $mlayout->writeMenu('Wiki Page', $title, '', '../');
		?>
		<?
		$mcontent = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."

			<div class=\"wiki\">
					".$wikistr."
			</div>
		</div>";
		?>
		<?
		//$header ='';
		//$mcontent = '<div id="mcontent" class="mcontent">
		//test
		//</div>';
		echo printBasicLayout($mlayout, $header, $menu, $mcontent, '../');
		?>
		<script>
		<?
			for ( $i = 0; $i < count($subscriber_id_list); $i++ ) {
				$json = $json.$subscriber_id_list[$i];
				if ( $i < count($subscriber_id_list)-1 )
					$json = $json.",";
			}
		?>
			$(document).ready(function() {
				url = '../update_rating.php?url=http://airabooks.com/wiki/wikibook.php?bookcode=<?echo $_GET['bookcode'];?>';
				InsertComicRating(url);
				var json = '<?echo $json;?>';
				window.subs_id_list = json.split(',');
			});
		</script>
			
	</body>
</html>

