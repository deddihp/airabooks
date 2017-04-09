<!DOCTYPE html>

<html>
<head>

	<link rel="stylesheet" href="css/style.css" type="text/css">
<script src="jquery.min.js"></script>
	<script>
		$(window).scroll(function(e){
  			$el = $('.header');
			console.log($(this).scrollTop());
  			if ($(this).scrollTop() > 0 && $el.css('position') != 'fixed'){
    			$('.header').css({'position': 'fixed', 'top': '0px'});
  			}
		});
		$(document).ready(function() {
			console.log('WINDOW HEIGHT = '+$(window).height());   // returns height of browser viewport
			console.log('DOCUMENT HEIGHT = '+$(document).height()); // returns height of HTML document
			console.log('SCREEN HEIGHT = '+screen.height);	
			var height = screen.height+'px';
			$('.menu').css({'position':'fixed', 'height':height});
			//$(window).width();   // returns width of browser viewport
			//$(document).width(); // returns width of HTML document
			//for screen size you can use screen object in the following way:

			//screen.height;
			//screen.width;
		});
	</script>


</head>
<body>

	<div class="mheader">
	<div class="logo">
		<img src="images/airabooks.png" width="115px">
	</div>
	<div class="search">
		<form name="google_search" method="GET" action="google_search.php">
			<input type="text" name="search_text">
			<!--<input type="submit" name="search" value="search">-->
			<INPUT TYPE="image" SRC="images/search-button.gif" 
               WIDTH="33"  HEIGHT="32" 
              ALT="SUBMIT!"> 
		</form>
	</div>
</div>

<div class="mhome">
	<div class="mmenu">
		<ul>
			<li style="background-color:#d6d6d6">
				Home
			</li>
			<li class="border">
			<div></div></li>
			<li>
			New Release
			</li>
			<li>
			Most Popular
			</li>
			<li>
			Most Recommended
			</li>
			<li class="border">
			<div></div></li>
			<li>
			Browse Komik
			</li>
			<li>
			Browse Novel, Biography, Umum
			</li>
			<li class="border">
				<div></div>
			</li>
			<li>
				Peminjaman
			</li>
			<li>
				Peminjaman Hari Ini
			</li>
			<li class="border">
				<div></div>
			</li>
			<li>
			Genre
				<ul>
					<li>
					Detective
					</li>
					<li>
					Romance
					</li>
					<li>
					Drama
					</li>
					<li>
					Action
					</li>
					<li>
					Adventure Fantasy
					</li>
				</ul>
			</li>
			</ul>
	</div>
	<?
	$content = "<p>Genre Detektif</p>
			<img src=\"cover_small/DC.jpg\" align=\"left\" width=\"80px\" height=\"110px\">
			<span>
			Judul : Detektif Conan<br>
			Pengarang : Aoyama Gosho<br>
			Status : Bersambung<br>
			Popularitas , Recommended<br>
			<br>
			Detektif Conan (名探偵コナン Meitantei Konan?) adalah sebuah serial manga detektif yang ditulis dan digambar oleh Gōshō Aoyama. Sejak tahun 1994 cerita ini dipublikasikan ... <a href=#>see more</a>
			</span>";
	?>
	<div class="mcontent">
		<div class="box">
			<? echo $content; ?> 	
		</div>
		<div class="box" style="border-right:0px solid red">
			<? echo $content; ?>
		</div>
		<div class="hline"></div>
		<div class="box">
			<? echo $content; ?>
		</div>
		<div class="box"style="border-right:0px solid red">
			<? echo $content; ?>
		</div>
		
		<div class="hline"></div>
		<div class="boxlong">
			<p class="left">Most Recommended</p>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
				<p class="author">112 pembaca</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
				<p class="author">112 pembaca</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
				<p class="author">112 pembaca</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Dimana Kambing Hitam, disitu ada Kambing Congek</a></p>
				<p class="author">by. Aoyama Gosho & Deddi Hariprawira</p>
				<p class="author">112 pembaca</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Dimana Kambing Hitam, disitu ada Kambing Congek</a></p>
				<p class="author">by. Aoyama Gosho & Deddi Hariprawira</p>
				<p class="author">112 pembaca</p>
			</div>
			
		</div>
		<div class="hline"></div>
		
		<div class="boxlong">
			<p class="left">Most Popular</p>	
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Dimana Kambing Hitam, disitu ada Kambing Congek</a></p>
				<p class="author">by. Aoyama Gosho & Deddi Hariprawira</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Dimana Kambing Hitam, disitu ada Kambing Congek</a></p>
				<p class="author">by. Aoyama Gosho & Deddi Hariprawira</p>
			</div>
			

		</div>
	
		
		<div class="hline"></div>
		
		<div class="boxlong">
			<p class="left">New Title</p>	
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Detektif Conan</a></p>
				<p class="author">by. Aoyama Gosho</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Dimana Kambing Hitam, disitu ada Kambing Congek</a></p>
				<p class="author">by. Aoyama Gosho & Deddi Hariprawira</p>
			</div>
			<div>
				<img src="cover_small/DC.jpg" width="80px" height="110px">
				<p class="title"><a href=#>Dimana Kambing Hitam, disitu ada Kambing Congek</a></p>
				<p class="author">by. Aoyama Gosho & Deddi Hariprawira</p>
			</div>
			

		</div>	
	</div>

</div>

<div class="mfooter">
	<div>
		<div class="footer_img">
			<img src="images/airabooks.png" width="150px">
		</div>
		<div class="footer_1">
			<div class="footer_top"></div>
			<div class="footer_bottom">
				<a href=#>Tentang airabooks</a>
				&nbsp;
				&#169; <span>airabooks 2013</span>
			</div>
		</div>
	</div>
</div>



</body>
</html>

