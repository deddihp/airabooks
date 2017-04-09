<?
	session_start();
	
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	//$fb_info = getFBInfo($_SESSION['fb_id']);	
	$fb_info = getFBInfoOffline();	
	if ( $fb_info['subscriber_id'] == "" ) {
		echo "Maaf, Anda harus terdaftar sebagai anggota airabooks untuk melihat halaman ini.
<br>
Mari bergabung dengan airabooks, Registrasi Gratis Lho.;
		";
		return;
	}
	?>

<?
	if ( $_GET['type'] == 'INPUT' ) {
		/*echo $_GET['subscriber_id'];
		echo $_GET['content'];
		echo $_GET['name'];
		echo $_GET['quantity'];
		*/
		
		$subs_id = $_GET['subscriber_id'];
		if ( $_GET['subs_id'] != 'undefined' ) {
			$subs_id = 'SUBS-1-'.$_GET['subs_id'];
		}
		$query = "INSERT INTO book_sell VALUES(NOW(), '".$subs_id."','".$_GET['content']."','".$_GET['quantity']."')";
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
	?>		
		<span style="display:block">Terima Kasih Pesanan Anda sudah kami masukkan ke database.</span>
		<button onclick="javascript:showScreenCover('onsale.php')">Back</button>
	<?

		return;
	}


?>

		<span
				style="
					font-family:'Verdana';
					font-size:15px;
					font-weight:bold;
					margin:10px;
					//border:1px solid black;
					display:block;
				"
				>Pesan Buku</span>
		
<table border="0px" cellpadding="5px" cellspacing="0" bordercolor="#e2e2e2" class="user_profile">
				<tr style="border-bottom:1px solid #e2e2e2;">
					<td style="border-bottom:1px solid #e2e2e2;">
						ID Anggota
					</td>
					<td width="60%" style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $_SESSION['subscriber_id'];
					?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Nama
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $fb_info['full_name'];
					?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
					Alamat Email
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<?
							//echo $fb_info['email_address'];
					?>
					<?	
						if ( $fb_info['email_address'] != "" ) { 
					?>
						<input type="text" id="email_address"
						 
						 value="<?
							echo $fb_info['email_address'];
						?>">
					<? } else { ?>
						<input type="text" id="email_address">
					<? } ?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Judul
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<input type="text" id="content" ></input>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Banyak
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<input type="text" id="quantity" ></input>
					</td>
				</tr>
		<? if ( $fb_info['role'] == 'ADMIN' ) { ?>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						SUBS-1-
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<input type="text" id="id_subs" ></input>
					</td>
				</tr>
		<? } ?>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<button onclick="javascript:callOnSaleForm('onsale_jx.php', '<?echo "type=INPUT&name=".$fb_info['full_name']."&subscriber_id=".$fb_info['subscriber_id'];?>','content_screen_loader');">Submit</button>
					</td>
				</tr>
			</table>
	



<button onclick="javascript:showScreenCover('onsale.php')">Back</button>
