<!DOCTYPE html>
<? include 'mysql_comic.php'; 
	include 'book.php';
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->error_msg == "" && $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}
?>
<html>
<head>
	<?
		$fb->errorHandler($fb);	
	?>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Anggota', $fb);
			$layout->showUserMenu('Profil', $fb);
		?>
	</div>
	<?php
		//include 'book.php';
		//$booktitle = new BooksTitle();
	?>			
	<div class="body">
		<div class="forcontent">
				<div>
					<div>
						<div class="section">
							<p class="about">Selamat Datang, <? echo $fb->user_profile['name']; ?></p>
							<? 
							if ( $fb->synchstatus != "ACTIVE" ) {
								echo "<p class=\"about\"> Status sinkronisasi dengan keanggotaan airabooks anda belum Aktif.</p>";
								echo "<a class=\"about\" href=usersetting.php>klik di sini untuk mengaktifkan.</a>";
								echo "<p class=\"about\">Jabat Erat,</p><br>";
								echo "<p class=\"about\">airabooks</p>";
							} else {
							?>
							<?
								$query = "select * from subscriber where subscriber_id='".$fb->subscriber_id."'";
								$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
								$result = $mysql->query($query);
								$row = mysqli_fetch_array($result);
								
								$query = "select COUNT(*) as count from rent_history where subscriber_id='".$fb->subscriber_id."'";
								$cres = $mysql->query($query);
								$crow = mysqli_fetch_array($cres);
								$count = $crow['count'];
							?>
								<p class="about">
								Berikut adalah profil airabooks anda
									</p>
									<table class="profile">
										<tr class="one">
											<td class="small">ID Pelanggan</td>
											<td class="big"><?echo $row['subscriber_id'];?></td>
										</tr>
										<tr class="two">
											<td class="small">Nama</td>
											<td class="big"><?echo $row['full_name'];?></td>
										</tr>
										<tr class="one">
											<td class="small">Email Address</td>
											<td class="big"><?echo $row['email_address'];?></td>
										</tr>
										<tr class="two">
											<td class="small">Alamat</td>
											<td class="big"><?echo $row['living_address'];?></td>
										</tr>
										<tr class="one">
											<td class="small">No Telepon</td>
											<td class="big"><?echo $row['mobile_phone_number'];?></td>
										</tr>
										<tr class="two">
											<td class="small">Anda telah meminjam</td>
											<td class="big"><?echo $count;?> Buku di airabooks <a href="userhistory.php?">*cek riwayat</a></td>
										</tr>
									</table>
								<p class="about">
									Saat Ini anda sedang membaca
								</p>
								<?
								include 'rent.php';
								$rent = new RentInfo();
								$result = $rent->selectRentInfoBySubs($fb->subscriber_id);
								
								echo "
							<table>
								<tr class=\"title\" align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pengembalian</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								while ( $row = mysqli_fetch_array($result) ) {
									if ( $i % 2 == 0 ) 
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									$status = $row['late'];
									if ( $status <= 0 )
										$status = "0 hari";
									else {
										$status = $status." hari";
									}
									echo "<td><span class=\"cname\">".$status."</span></td>";
									echo "</tr>";
								}
							echo "</table>";
		


								?>
							<?}
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
