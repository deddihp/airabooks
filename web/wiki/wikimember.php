<?php
	//header('Content-Type: text/html; charset=utf-8');
	session_start();
	/* Define All Class */
	include '../lib/layout.php';
	include '../lib/mysql_comic.php';
	include '../lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$mcommon = new MemberLayout;
?>
<html>
	<title>Member</title>
	<head>
		<?php
			echo $mlayout->writeHeadParameter('../');
		?>
	</head>
	<body>
		<?
			$header = $mlayout->writeHeader('../');
		?>
		<?
			$menu = $mlayout->writeMenu('Member', "", '', '../');
		
		$mcontent = "
		<div class=\"mcontent\" id=\"mcontent\">";
		
		if ( isset($_SESSION['status']) && $_SESSION['status'] == 'ACTIVE' ) {
			$mcontent = $mcontent . 
			"<div class=\"boxlong_detail\" >
				<p class=\"left\">Anggota</p>";
			
				if ( $_SESSION['fb_id'] != '' ) {
					$drows = 40;
					$local_search = $_GET['local_search'];
					$cur_offset = $_GET['offset'];
					$cur_offset = ($cur_offset=="")?0:$cur_offset;
					$content = $mcommon->writeMemberGroup($cur_offset, $drows, $local_search, $subscriber_id_list);
					$numrows = $mcommon->getMemberNumRows($local_search);	
			
			
					for ( $i = 0; $i < count($subscriber_id_list); $i++ ) {
						$json = $json.$subscriber_id_list[$i];
						if ( $i < count($subscriber_id_list)-1 )
							$json = $json.",";
					}
				}
			?>
			<script>
			$(document).ready(function() {
					var json = '<?echo $json;?>';
					window.subs_id_list = json.split(',');
				});
			</script>
			<?
				$next_var = ($cur_offset+$drows>$numrows)?$cur_offset:$cur_offset+$drows;
				$prev_var = ($cur_offset-$drows<0)?0:($cur_offset-$drows);
				$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+$drows>$numrows)?$numrows:$cur_offset+$drows)." of ".$numrows;
				$action_handler = "wikimember.php";
			?>
			<?
			$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form  class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>";
			?>
			<?
			echo "local = ".$local_search;
			$mcontent = $mcontent . $nav_var;
			$mcontent = $mcontent . "<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=".$action_handler.">
					<input style=\"border:1px solid black;height:24px;\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>";
			
				for ( $i = 0; $i < count($content); $i++ ) {
					$mcontent = $mcontent . $content[$i];
					if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != $drows-1)
						$mcontent = $mcontent . "<div class=\"hline\"></div>";
				}
		$mcontent = $mcontent . 
		"</div>";
		
		$mcontent = $mcontent . $nav_var;
	} else { 
		$mcontent = $mcontent . "
		<p style=\"font:normal 14px/14px arial, sans-serif;\">
		 Maaf, Anda harus terdaftar sebagai anggota airabooks untuk melihat halaman ini.
		</p>";
		$mcontent = $mcontent . "
		<p style=\"font:normal 14px/14px arial, sans-serif;\">
		Mari bergabung dengan airabooks, Registrasi Gratis Lho.
		</p>";
		if ( $_SESSION['status'] == 'NOT ACTIVE' ) {
			$mcontent = $mcontent . "
			<p style=\"font:normal 14px/14px arial, sans-serif;\">
				Lakukan aktifasi dengan meng klik 'Aktifkan akun anda' di menu yang terletak di foto profile anda di sebelah kanan atas.
			</p>";
		}
	}
				
		$mcontent = $mcontent . "</div>";
		
		
		echo printBasicLayout($mlayout, $header, $menu, $mcontent);
	?>
	</body>
</html>
