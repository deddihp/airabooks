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
<html>
	<head>
		<title>About</title>
		<?
			$description = "Persewaan Komik, Novel dan CD/DVD Original.";
			echo writeMetaInfo($description);
		?>
		<?php
			echo $mlayout->writeHeadParameter('../');
		?>

	</head>
	<body>
		<?
			//$rpop->getPopularRandom();
			echo $mlayout->writeHeader('../');
		?>
	<div id="maincontent" class="maincontent">	
	<?
			echo $mlayout->writeMenu('About', "About", "", "../");
		?>
		<div class="mcontent" id="mcontent">
			<div class="wiki">
				<p class="wiki-title">About</p>
				<p class="about">
				Persewaan buku airabooks yang mulai beroperasi pada tanggal 7 April 2012 didirikan dengan mengusung beberapa ide yang mungkin agak muluk untuk usaha yang 'cuma' menyewakan buku komik dan novel. 
				Ide nya adalah dengan memaksimalkan Teknologi Informasi untuk digunakan ke dalam kegiatan transaksi di airabooks. 
				</p>
				<p class="about">Tentu saja kalau kita berbicara tentang Teknologi Informasi banyak sekali disiplin ilmu yang terlibat didalamnya seperti database, software, networking dan masih banyak lagi. Namun dibalik banyaknya tantangan tersebut, dengan menggunakan Teknologi Informasi/Sistem informasi akan memberikan suatu keuntungan yang luar biasa baik untuk pengelola maupun anggota, seperti :
				</p>
				<p class="about">
				Untuk pengelola :
	<ul class="about">
		<li>
			Tahu buku mana yang dipinjam dan berapa hari telatnya dengan sekali klik (bayangkan kalau pake kertas). 
		</li>
		<li>
			Bisa mengurangi resiko kehilangan buku juga, kehilangan satu buku saja akan sangat besar efeknya.
		</li>
		<li>
			Bisa dipakai untuk menghitung statistik. Bisa dilihat berapa banyak anggotanya, berapa jumlah cowok dan ceweknya, berapa banyak buku yang tersedia, apa buku paling populer, siapa anggota dengan peminjaman terbanyak dll.
		</li>
		<li>
			Bisa dipakai untuk melengkapi buku2 yang tidak lengkap
		</li>
		<li>
			Dan kalau dikombinasikan dengan teknologi barcode, proses transaksinya diyakini bisa cepat.
		</li>
	</ul>
	<p class="about">
Untuk anggota :
	</p>
	<p class="about">
	Berdasarkan pengalaman, banyak anggota yang selalu tanya, buku ini ada ga ?. kalau ga ada ini bolong atau dipinjam ?. yang pinjam siapa ?. Pertanyaan - pertanyaan seperti itu akan sangat sulit dijawab jika tidak memakai sistem informasi.
	</p>
	<p class="about">
Dan saat ini airabooks sudah memiliki website untuk memudahkan para anggota mendapatkan informasi seputar buku - buku yang disewakan di airabooks.
	</p>
	<p class="about">
	Untuk mengetahui apa yang bisa anggota dapatkan dari situs airabooks ini akan diulas di artikel lainnya.
	<br>
	<br>
	Jabat Erat,
	<br><br>
	Tim airabooks
			</div>
		</div>
		<?
			echo $mlayout->writeFooter('../');
		?>
		
	</div>
	</body>
</html>

