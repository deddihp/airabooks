
<!DOCTYPE html>




<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		
			<link rel="stylesheet" href="css/style.css" type="text/css">
			<script src="jquery.min.js"></script>
			<script>
  				(function() {
    				var cx = '011619598497550101864:sajtfnwz8ta';
    				var gcse = document.createElement('script');
    				gcse.type = 'text/javascript';
    				gcse.async = true;
    				gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        			'//www.google.com/cse/cse.js?cx=' + cx;
    				var s = document.getElementsByTagName('script')[0];
    				s.parentNode.insertBefore(gcse, s);
  				})();
			</script>
			
			
		
		<script>
			window.onresize = function(event) {
				console.log(event);
				console.log($(window).width());
				var str = "\""+$(window).width()+"px\"";
				console.log(str);
				str = "1716px";
				document.getElementById('mheader').style.width = $(window).width()+"px";
				document.getElementById('maincontent').style.width = $(window).width()+"px";
				//"1716px";
				//$(window).width();
			}
			function closeScreenCover() {
				document.getElementById('cover_screen').setAttribute("style", 
					"display:none;");
				document.getElementById('screen_loader').setAttribute("style", "display:none;");
				
			}
			function showScreenCover(url) {
				var height = screen.height;//window.innerHeight || document.body.clientHeight;
				var width = 100;//(window.innerWidth || document.body.clientWidth);
				//if (height < 1000 )
				//	height = 1000;
				var style = "display:fixed;position:fixed;z-index:30;border:0px solid #e2e2e2;background-color:black;opacity:0.8;width:"+
				width+"%;"+
				"height:"+height+
				"px;";
				document.getElementById('cover_screen').setAttribute("style", 
					style);
				var width_div = 1000;
				var hw = width_div / 2;
				var hscreen = screen.width / 2;
				var left = hscreen - hw - 10;
				if ( left < 0 )
					left = 0;
				style = "display:block;position:absolute;border:2px solid #e2e2e2; border-radius:10px; top:30px; left:"+left+"px; width:"+width_div+"px; z-index:31;margin:0px;padding:10px;background:white;";
				document.getElementById('screen_loader').setAttribute("style", style);
				loadHTML(url, 'content_screen_loader');
				
			}
			function loadHTML(url, loader) {
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
    						console.log('ok');
							document.getElementById(loader).innerHTML = xmlhttp.responseText;
						}
  					}
				xmlhttp.open("GET",url,true);
				res = xmlhttp.send();
				console.log(xmlhttp.responseHtml);
			
			}
			function showInfo(info, loader, bookcode) {
				console.log(info+" "+loader);
				document.getElementById(info).setAttribute("style", 
					"display:block;position:absolute;z-index:5;border:0px solid #e2e2e2;background-color:blue;");
					//var doc = "
					//<iframe src=snapshot.php?bookcode="+bookcode+"></iframe>
					//";

					//document.getElementById(loader).innerHTML = "<iframe style='border:0px; display:table; width:100%;' src=snapshot.php?bookcode="+bookcode+"></iframe>";		
					loadHTML('snapshot.php?bookcode='+bookcode, loader);
				//"display:block;border:1px solid block; position:absolute;width:100px;height:100px;z-index=2");
				//var left = document.getElementById(info).position();//getAttribute("left");
				//console.log(left.left);
			}
			var flag_hide = true;
			function hideInfo(info) {
				//console.log(info);
				if ( flag_hide == true )
				document.getElementById(info).setAttribute("style", "display:none;");
			}
			function overOnInfo(info) {
				flag_hide = false;
				console.log('capture overOnInfo');
				document.getElementById(info).setAttribute("style", 
					"display:block;position:absolute;z-index:5;border:0px solid #e2e2e2;background-color:blue;");
					
			}
			function outFromInfo(info) {
				flag_hide = true;
				document.getElementById(info).setAttribute("style", 
					"display:none");	
			}
		</script>
		
			<script>
				function profile_show(id) {
					$('#'+id).show();
					console.log('profile = '+id);
				}
				function profile_hide(id) {
					$('#'+id).hide();
				}
				var hide = 1;
				function ShowHideDiv(id) {
					if ( hide == 1 ) {
						$('#'+id).show();
						hide = 0; 
					} else {
						$('#'+id).hide();
						hide = 1;
					}
				}
			</script>
		
		<script>
			function allowDrop(ev)
			{
				ev.preventDefault();
			}

			function drag(ev)
			{
				ev.dataTransfer.setData("Text",ev.target.id);
			}

			function drop(ev)
			{
				ev.preventDefault();
				var data=ev.dataTransfer.getData("Text");
				ev.target.appendChild(document.getElementById(data));
			}
		</script>
		
			<script>
				function ShowCollection(id) {
					el = document.getElementById(id);
					if ( el.innerHTML == '- Lihat Koleksi -' ) {
						$('#Collection').show();
						(el).innerHTML = '- Sembunyikan Koleksi -';
					} else {
						$('#Collection').hide();
						(el).innerHTML = '- Lihat Koleksi -';
					}
				}
			</script>
				<script>
			$(document).ready(function() {
				//$('#mcontent').fadeOut();
				var con = 'mcontent';
				console.log($('#'+con));
				//$('#'+con).fadeOut();
				//console.log(con);
				console.log(document.getElementById('mcontent'));
			});
		</script>
	</head>
	<body>
	
	
	<div id="cover_screen"></div>
		<div style="position:absolute;display:none" id="screen_loader">
			<div style="
				position:absolute;
				right:-20px;
				top:-20px;
				float:right;">
				<a href="" onclick="javascript:closeScreenCover(); return false;"><img src="images/close.png" width="40px"></a>
			</div>
			<div style="background-color:white;display:table;text-align:center; width:100%; border:0px solid black;" id="content_screen_loader">
				<img src="images/ajax-loading.gif">
			</div>
		</div>
		
		<div id="fb-root"></div>	
		<script type="text/javascript">	
			function InsertComicRating(url)
				{
					//if (str=="")
  					//{
  						//	document.getElementById("txtHint").innerHTML="";
  						//	return;
  					//} 
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
    						//document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    					}
  					}
					//console.log('insert comic rating url='+url);
					xmlhttp.open("GET",url,true);
					res = xmlhttp.send();
					//console.log(res);
				}
			window.fbAsyncInit = function() {
 				FB.init({
					//appId: '159457617553432',
					appId: '116943728442196', 
					status: true, 
					cookie: true, 
					xfbml: true
				});
 
 			FB.Event.subscribe('auth.authResponseChange', function(response) {
    			if (response.status === 'connected') {
     				testAPI();
    				console.log('connected');
				} else if (response.status === 'not_authorized') {
     				FB.login();
					console.log('reponse changed');
    			} else {
     				console.log('reponse changed2 -> '+response.status);
				
					//FB.login();
    			}
			})
			FB.Event.subscribe('edge.create', function(href, widget) {
 				// Do something, e.g. track the click on the "Like" button here
 							alert('You just liked '+href);
 					//		console.log('You just liked '+href);
					//window.location.href = 
					url = 'update_rating.php?url='+href;
					InsertComicRating(url);
				});

				FB.Event.subscribe('edge.remove', function(href, widget) {
   					alert('dislike '+href);
					//console.log('unlike blabla ' + href);
   					//window.location.href = 
					url = 'update_rating.php?url='+href;
					InsertComicRating(url);
				});
			};
			
	/*	(function() {
 			var e = document.createElement('script');
 			e.type = 'text/javascript';
 			e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 			e.async = true;
 			document.getElementById('fb-root').appendChild(e);
 		}());

		(function(d, s, id) {
  			var js, fjs = d.getElementsByTagName(s)[0];
  			if (d.getElementById(id)) return;
  			js = d.createElement(s); js.id = id;
  			//js.src = "//connect.facebook.net/en_US/all.js";
  
  			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=159457617553432";
  			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	*/	
		// Load the SDK asynchronously
  	(function(d){
   		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   		if (d.getElementById(id)) {return;}
   		js = d.createElement('script'); js.id = id; js.async = true;
   		js.src = "//connect.facebook.net/en_US/all.js";
   		ref.parentNode.insertBefore(js, ref);
  	}(document));

		function testAPI() {
    		console.log('Welcome!  Fetching your information.... ');
    		FB.api('/me', function(response) {
      			console.log('Good to see you, ' + response.name + '.'+' id=> '+ response.id);
    		
				loadHTML('content_profile.php?fb_id='+response.id, 'content_profile_loader');
			//loadHTML('show_faces.php', 'fb_container_footer');
			});
			$('#fb_container').hide();
			$('#fb_container_footer').show();
			$('#profile_menu').show();
		}
		
       	function fb_logout(){
     		console.log('Logout Facebook From');
			FB.logout(function(response) {
        		$('#fb_container').show();
				$('#fb_container_footer').hide();
				$('#profile_menu').hide();
		
				window.location = "http://localhost/airabooks/aira";
			});
 		}
		</script>
		
		<div id="mheader" class="mheader">
			<div style="display:block;border:0px solid black;position:absolute;z-index:2;" class="logo">
				<img id="drag1" draggable="true" ondragstart="drag(event)"  src="images/airabooks.png" width="110px">
			</div>
			<div class="search"><div style="position:relative;left:190px;border:0px solid black">	
			<gcse:searchbox-only class="gsearch" style="border:1px solid black"></gcse:search>
			</div></div>
		<div id="fb_container" style="position:absolute;
				//left:-70px;
				float:right;
				right:40px;	
				top:2px;
				width:70px;
				height:40px;
				//border:1px solid red;
			">
			<fb:login-button style="border:0px solid black; 
				margin-top:10px;" show-faces="false" width="200" max-rows="1"></fb:login-button>
		</div>
		<div id="profile_menu" style="
				display:none;
				position:absolute;
				//left:-70px;
				float:right;
				right:20px;	
				top:2px;
				width:70px;
				height:40px;
				//border:1px solid red;
			">
		<a href="" class="style1" 
			style="
				padding:3px;
				margin:0px;
				width:63px;
				height:40px;
				//border:1px solid blue;
			" 
			onclick="return false;">
		<nav class="drop-menu">		
				<img class="profile" id="img_profile" src="https://graph.facebook.com/1192425363/picture" height="40px"
					style="float:left"
				>
				<div style="
					position:absolute;
					width:0;
					height:0;
					float:left;
					top:20px;
					right:5px;
					border-top:10px solid #bfbfbf;
					border-left:10px solid transparent;
					border-right:10px solid transparent;
				"></div>
				
				<div class="profile_content" id="profile_content" style="
					//display:table;
					display:none;
					position:absolute;
				//	border:1px solid black;
					width:320px;
					height:200px;
					left:-260px;
					top:40px;
				//	background-color:white;
					z-index:1;
					">
					<div style="
						position:absolute;
						width:0;
						height:0;
						right:25px;
						border-bottom:15px solid #bfbfbf;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						">
					</div>
					<div style="
						position:absolute;
						width:0;
						height:0;
						top:1px;
						right:25px;
						border-bottom:15px solid white;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						z-index:2;
						">
					</div>
				</div><ul style="position:absolute;width:0; height:0px;
			"><li>
		<div id="" style="
			position:relative;
			//display:none;
			display:block;
			width:0;
			height:0;
			top:0px;
			left:0px;
			//border:1px solid green;
		">
			<!-- Main Div -->
			<div style="
				padding:0px;
				margin:0px;
				position:absolute;
				top:13px;
				left:-250px;
				//background:white;
				width:300px;
			//	border:1px solid red;
				z-index:21;
				">
				<!-- Div Arrow -->
				<div style="
					position:relative;
					display:table;
					width:100%;
			//		border:1px solid yellow;
					//height:3px;
				">
					<div style="
						position:absolute;
						left:247px;
						top:0px;
						width:0;
						height:0;
						border-bottom:15px solid #e2e2e2;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						z-index:5;
					">
					</div>
					<div style="
						position:absolute;
						left:247px;
						top:1px;
						width:0;
						height:0;
						border-bottom:15px solid white;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						z-index:6;
					">
					</div>
				</div>
		<!--
					Table Arrow Top -->
					<table 
					style="
						margin:5px 0 0 0;
					"
					width="300px" 
					border="0px" 
					cellpadding="0" 
					cellspacing="0"><tr>
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						">
						</td>
						<td width="10px" style="
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						">
						</td>
					</tr>
					<tr>
						<td width="10px" style="background:url(images/bg-blend-left.png) 3px 0px repeat-y;">
						</td>
						<td>
							<div style="
								//height:200px; 
								display:table;
								width:100%;
								border:1px solid #e2e2e2;
								padding:0;
								margin:0;
								background:white">
								<div id="content_profile_loader"></div>	
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
						</td>
					</tr>
					<tr >
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div></li></ul></nav>
			</a>
		</div>
		</div>
			<div id="maincontent" class="maincontent">	
	
	<div class="mmenu"><ul class="mainmenu">
<li class="border"><div></div></li>
<li style="background-color:#bfbfbf;"><a class="mainmenu-selected" href=index.php style="">Home</a></li><li>
<a class="mainmenu" href=#>airabooks' wiki</a>
<ul class="mainmenu" style="border:1px solid #e2e2e2;width:179px;background-color:white;padding:5px 5px 5px 20px;
					width:149px;"><li><a class="mainmenu" href=wiki.php>Wiki Page</a></li><li><a class="mainmenu" href=wikiabout.php>About</a></li><li><a class="mainmenu" href=wikistaff.php>Staff</a></li><li><a class="mainmenu" href=wikihelp.php>Bantuan</a></li></ul></li><li class="border"><div></div></li>
<li><a class="mainmenu" href=newrelease.php>New Release</a></li>
<li><a class="mainmenu" href=booksofthemonth.php>Books Of The Month</a></li>
<li>
<nav class="drop-menu">
<a class="mainmenu"
												style="border:0px solid black; position:relative;" href="mostpopular.php" >Most Popular<span class="arrow-right"></span>
						</a>
<ul style="
						border:0px solid blue;
						list-style:none; margin:0px padding:0px;"><li style="margin:0px; padding:0px;">
		<div id="Most_Popular" style="
			position:relative;
			//display:none;
			display:block;
			width:0;
			height:0;
			top:0px;
			left:0px;
			//border:1px solid green;
		">
			<!-- Main Div -->
			<div style="
				padding:0px;
				margin:0px;
				position:absolute;
				top:-100px;
				left:55px;
				//background:white;
				width:148px;
			//	border:1px solid red;
				z-index:21;
				">
				<!-- Div Arrow Left --> 
				<div style="
					position:relative;
					float:left;
					display:table;
					width:0px;
					//border:1px solid grey;
					height:0px;
					z-index:6;
				">
					<div style="
						position:absolute;
						left:0px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid #e2e2e2;
						border-top:15px solid transparent;
						z-index:10;
						z-index:6;
					">
					</div>
					<div style="
						position:absolute;
						left:1px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid white;
						border-top:15px solid transparent;
						z-index:7;
					">
					</div>
				</div><!--
					Table Arrow Left-->
					<table style="
						margin:0 0 0 5px;
						float:left" 
						width="148px" 
						border="0px" 
						cellpadding="0" 
						cellspacing="0"><tr>
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						">
						</td>
						<td width="10px" style="
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						">
						</td>
					</tr>
					<tr>
						<td width="10px" style="background:url(images/bg-blend-left.png) 3px 0px repeat-y;">
						</td>
						<td>
							<div style="
								//height:200px; 
								display:table;
								width:100%;
								border:1px solid #e2e2e2;
								padding:0;
								margin:0;
								background:white">
								
					<ul style="width:115px; margin:5px 0 5px 0; padding:5px 0 0 5px;" class="mainmenu">
	<li><a class="mainmenu" href=mostpopular.php>Semua Genre</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Adventure+Fantasy>Genre Fantasy</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Drama>Genre Drama</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Romance>Genre Romance</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Action>Genre Action</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Comedy>Genre Comedy</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=History>Genre History</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Detective>Genre Detektif</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Mystery>Genre Misteri</a></li>
	<li><a class="mainmenu" href=mostpopular.php?genre=Sport>Genre Olahraga</a></li>
</ul>	
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
						</td>
					</tr>
					<tr >
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div></li></ul></nav>
</li>
<li>
<nav class="drop-menu">
<a class="mainmenu"
												style="border:0px solid black; position:relative;" href="mostrecommended.php" >Most Recommended<span class="arrow-right"></span>
						</a>
<ul style="
						border:0px solid blue;
						list-style:none; margin:0px padding:0px;"><li style="margin:0px; padding:0px;">
		<div id="Most_Recommended" style="
			position:relative;
			//display:none;
			display:block;
			width:0;
			height:0;
			top:0px;
			left:0px;
			//border:1px solid green;
		">
			<!-- Main Div -->
			<div style="
				padding:0px;
				margin:0px;
				position:absolute;
				top:-100px;
				left:98px;
				//background:white;
				width:148px;
			//	border:1px solid red;
				z-index:21;
				">
				<!-- Div Arrow Left --> 
				<div style="
					position:relative;
					float:left;
					display:table;
					width:0px;
					//border:1px solid grey;
					height:0px;
					z-index:6;
				">
					<div style="
						position:absolute;
						left:0px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid #e2e2e2;
						border-top:15px solid transparent;
						z-index:10;
						z-index:6;
					">
					</div>
					<div style="
						position:absolute;
						left:1px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid white;
						border-top:15px solid transparent;
						z-index:7;
					">
					</div>
				</div><!--
					Table Arrow Left-->
					<table style="
						margin:0 0 0 5px;
						float:left" 
						width="148px" 
						border="0px" 
						cellpadding="0" 
						cellspacing="0"><tr>
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						">
						</td>
						<td width="10px" style="
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						">
						</td>
					</tr>
					<tr>
						<td width="10px" style="background:url(images/bg-blend-left.png) 3px 0px repeat-y;">
						</td>
						<td>
							<div style="
								//height:200px; 
								display:table;
								width:100%;
								border:1px solid #e2e2e2;
								padding:0;
								margin:0;
								background:white">
								
					<ul style="width:115px; margin:5px 0 5px 0; padding:5px 0 0 5px;" class="mainmenu">
	<li><a class="mainmenu" href=mostrecommended.php>Semua Genre</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Adventure+Fantasy>Genre Fantasy</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Drama>Genre Drama</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Romance>Genre Romance</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Action>Genre Action</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Comedy>Genre Comedy</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=History>Genre History</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Detective>Genre Detektif</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Mystery>Genre Misteri</a></li>
	<li><a class="mainmenu" href=mostrecommended.php?genre=Sport>Genre Olahraga</a></li>
</ul>	
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
						</td>
					</tr>
					<tr >
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div></li></ul></nav>
</li>
<li class="border"><div></div></li>
<li>
<nav class="drop-menu">
<a class="mainmenu"
												style="border:0px solid black; position:relative;" href="browsecomic.php" >Browse Komik<span class="arrow-right"></span>
						</a>
<ul style="
						border:0px solid blue;
						list-style:none; margin:0px padding:0px;"><li style="margin:0px; padding:0px;">
		<div id="Browse_Komik" style="
			position:relative;
			//display:none;
			display:block;
			width:0;
			height:0;
			top:0px;
			left:0px;
			//border:1px solid green;
		">
			<!-- Main Div -->
			<div style="
				padding:0px;
				margin:0px;
				position:absolute;
				top:-100px;
				left:62px;
				//background:white;
				width:148px;
			//	border:1px solid red;
				z-index:21;
				">
				<!-- Div Arrow Left --> 
				<div style="
					position:relative;
					float:left;
					display:table;
					width:0px;
					//border:1px solid grey;
					height:0px;
					z-index:6;
				">
					<div style="
						position:absolute;
						left:0px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid #e2e2e2;
						border-top:15px solid transparent;
						z-index:10;
						z-index:6;
					">
					</div>
					<div style="
						position:absolute;
						left:1px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid white;
						border-top:15px solid transparent;
						z-index:7;
					">
					</div>
				</div><!--
					Table Arrow Left-->
					<table style="
						margin:0 0 0 5px;
						float:left" 
						width="148px" 
						border="0px" 
						cellpadding="0" 
						cellspacing="0"><tr>
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						">
						</td>
						<td width="10px" style="
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						">
						</td>
					</tr>
					<tr>
						<td width="10px" style="background:url(images/bg-blend-left.png) 3px 0px repeat-y;">
						</td>
						<td>
							<div style="
								//height:200px; 
								display:table;
								width:100%;
								border:1px solid #e2e2e2;
								padding:0;
								margin:0;
								background:white">
								
					<ul style="width:115px; margin:5px 0 5px 0; padding:5px 0 0 5px;" class="mainmenu">
	<li><a class="mainmenu" href=browsecomic.php>Semua Genre</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Adventure+Fantasy>Genre Fantasy</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Drama>Genre Drama</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Romance>Genre Romance</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Action>Genre Action</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Comedy>Genre Comedy</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=History>Genre History</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Detective>Genre Detektif</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Mystery>Genre Misteri</a></li>
	<li><a class="mainmenu" href=comic_genre.php?genre=Sport>Genre Olahraga</a></li>
</ul>	
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
						</td>
					</tr>
					<tr >
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div></li></ul></nav>
</li>
<li>
<nav class="drop-menu">
<a class="mainmenu"
												style="border:0px solid black; position:relative;" href="browsenovel.php" >Browse Novel<span class="arrow-right"></span>
						</a>
<ul style="
						border:0px solid blue;
						list-style:none; margin:0px padding:0px;"><li style="margin:0px; padding:0px;">
		<div id="Browse_Novel" style="
			position:relative;
			//display:none;
			display:block;
			width:0;
			height:0;
			top:0px;
			left:0px;
			//border:1px solid green;
		">
			<!-- Main Div -->
			<div style="
				padding:0px;
				margin:0px;
				position:absolute;
				top:-100px;
				left:58px;
				//background:white;
				width:148px;
			//	border:1px solid red;
				z-index:21;
				">
				<!-- Div Arrow Left --> 
				<div style="
					position:relative;
					float:left;
					display:table;
					width:0px;
					//border:1px solid grey;
					height:0px;
					z-index:6;
				">
					<div style="
						position:absolute;
						left:0px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid #e2e2e2;
						border-top:15px solid transparent;
						z-index:10;
						z-index:6;
					">
					</div>
					<div style="
						position:absolute;
						left:1px;
						top:75px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid white;
						border-top:15px solid transparent;
						z-index:7;
					">
					</div>
				</div><!--
					Table Arrow Left-->
					<table style="
						margin:0 0 0 5px;
						float:left" 
						width="148px" 
						border="0px" 
						cellpadding="0" 
						cellspacing="0"><tr>
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						">
						</td>
						<td width="10px" style="
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						">
						</td>
					</tr>
					<tr>
						<td width="10px" style="background:url(images/bg-blend-left.png) 3px 0px repeat-y;">
						</td>
						<td>
							<div style="
								//height:200px; 
								display:table;
								width:100%;
								border:1px solid #e2e2e2;
								padding:0;
								margin:0;
								background:white">
								
					<ul style="width:115px; margin:5px 0 5px 0; padding:5px 0 0 5px;" class="mainmenu">
	<li><a class="mainmenu" href=browsenovel.php>Semua Genre</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Adventure+Fantasy>Genre Fantasy</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Drama>Genre Drama</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Romance>Genre Romance</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Action>Genre Action</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Comedy>Genre Comedy</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=History>Genre History</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Detective>Genre Detektif</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Mystery>Genre Misteri</a></li>
	<li><a class="mainmenu" href=novel_genre.php?genre=Sport>Genre Olahraga</a></li>
</ul>	
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
						</td>
					</tr>
					<tr >
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div></li></ul></nav>
</li>
<li class="border"><div></div></li>
<li><a class="mainmenu" href=rentinfo.php>Peminjaman</a></li>
<li><a class="mainmenu" href=renttoday.php>Peminjaman Hari Ini</a></li>
<li class="border"><div></div></li>
<li><a class="mainmenu" href=byrequest.php>By Request</a></li>
</ul>
</div>
		<div class="mcontent" id="mcontent">
		
		<!--<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>-->
		<div class="box">
					<p><a href=genresport.php>Genre Sport</a></p>
					<div class="img" style="margin:0px 5px 5px 0px">
						<img src="cover_small/CPT.jpg" width="80px" height="110px">
					</div>	
				<span>
				Judul : <a href=wikibook.php?bookcode=CPT>Captain Tsubasa</a><br>
				Pengarang : Yoichi Takahashi<br>
				Status : Tamat<br>
				<div id="star">
					<ul id="star0" class="star">
  						<li id="starCur0" class="curr" title="none" style="width: 5px;"></li>
 					</ul>
				</div>
				<div style="border:1px solid transparent;width:10px; float:left"></div>
				<div id="likerating">
 					<ul id="star0" class="star">
  					<li id="starCur0" class="curr" title="9" style="width: 0px;"></li>
 					</ul>
				</div>
			
				<br><br>
				Tsubasa adalah seorang anak SD yang baru saja pindah dari kota lain ke Nankatsu. Dia ingin bermain sepak bola dan menjadi pemain terbaik. Ketika masuk ke sekolah barunya, dia langsung masuk ke klub sepak bola di sekolah itu. Kapten klub itu adalah Ishizaki. Mereka lalu berlatih di lapangan, tetapi d...<a href=wikibook.php?bookcode=CPT>see more</a>
			</span></div><div class="box" style="border-right:0px;">
					<p><a href=genremystery.php>Genre Mystery</a></p>
					<div class="img" style="margin:0px 5px 5px 0px">
						<img src="cover_small/NGAR.jpg" width="80px" height="110px">
					</div>	
				<span>
				Judul : <a href=wikibook.php?bookcode=NGAR>Nube guru ahli roh</a><br>
				Pengarang : shou makura takeshi okano<br>
				Status : Bersambung<br>
				<div id="star">
					<ul id="star0" class="star">
  						<li id="starCur0" class="curr" title="none" style="width: 8px;"></li>
 					</ul>
				</div>
				<div style="border:1px solid transparent;width:10px; float:left"></div>
				<div id="likerating">
 					<ul id="star0" class="star">
  					<li id="starCur0" class="curr" title="9" style="width: 0px;"></li>
 					</ul>
				</div>
			
				<br><br>
				Manga ini terdiri dari beberapa bab. Biasanya setiap bab memiliki cerita yang berbeda. Topik utama dalam serial Nube adalah makhluk supranatural dan fenomena misterius, maka kebanyakan episode menceritakan kisah pertemuan antara makhluk supranatural dengan salah satu murid Nube. Seringkali murid Nub...<a href=wikibook.php?bookcode=NGAR>see more</a>
			</span></div>
					<div class="hline"></div>
				<div class="box">
					<p><a href=genredetektif.php>Genre Detective</a></p>
					<div class="img" style="margin:0px 5px 5px 0px">
						<img src="cover_small/CMB.jpg" width="80px" height="110px">
					</div>	
				<span>
				Judul : <a href=wikibook.php?bookcode=CMB>C.M.B</a><br>
				Pengarang : Motohiro Katou<br>
				Status : Bersambung<br>
				<div id="star">
					<ul id="star0" class="star">
  						<li id="starCur0" class="curr" title="none" style="width: 10px;"></li>
 					</ul>
				</div>
				<div style="border:1px solid transparent;width:10px; float:left"></div>
				<div id="likerating">
 					<ul id="star0" class="star">
  					<li id="starCur0" class="curr" title="9" style="width: 9px;"></li>
 					</ul>
				</div>
			
				<br><br>
				Di sebuah hutan kecil dalam kota, terdapat sebuah museum. Museum Shinra, demikian namanya. Pemiliknya seorang anak laki-laki bernama Shinra Sakaki, pemilik ketiga cincin C.M.B yang konon merupakan simbol ilmu pengetahuan yang turun-temurun diserahkan oleh Tiga Orang Bijak pelindung The British Museu...<a href=wikibook.php?bookcode=CMB>see more</a>
			</span></div><div class="box" style="border-right:0px;">
					<p><a href=genrefantasy.php>Genre Adventure Fantasy</a></p>
					<div class="img" style="margin:0px 5px 5px 0px">
						<img src="cover_small/BLC.jpg" width="80px" height="110px">
					</div>	
				<span>
				Judul : <a href=wikibook.php?bookcode=BLC>Bleach</a><br>
				Pengarang : Tite Kubo<br>
				Status : Bersambung<br>
				<div id="star">
					<ul id="star0" class="star">
  						<li id="starCur0" class="curr" title="none" style="width: 21px;"></li>
 					</ul>
				</div>
				<div style="border:1px solid transparent;width:10px; float:left"></div>
				<div id="likerating">
 					<ul id="star0" class="star">
  					<li id="starCur0" class="curr" title="9" style="width: 38px;"></li>
 					</ul>
				</div>
			
				<br><br>
				Bleach bercerita tentang Ichigo Kurosaki, seorang pelajar SMA yang memiliki kemampuan untuk melihat roh, dan juga Rukia Kuchiki, seorang shinigami (dewa kematian) yang pada suatu hari bertemu dengan Ichigo sewaktu sedang memburu roh jahat yang disebut hollow. Pada saat Rukia bertarung melawan hollow...<a href=wikibook.php?bookcode=BLC>see more</a>
			</span></div><div class="hline"></div><div class="boxlong">
			<p class="left"><a href=newrelease.php>New Release 10 Mei 2013</a></p>
		
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=CTLO><img style="z-index:-1;" 
		onmouseout="hideInfo('CTLO1')" 
		onmouseover="showInfo('CTLO1', 'loaderCTLO1','CTLO')" 
		src="cover_small/CTLO.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="CTLO1" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('CTLO1');"  onmouseout="outFromInfo('CTLO1');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowCTLO1"
								onmouseover="overOnInfo('CTLO1');"  
								onmouseout="outFromInfo('CTLO1');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderCTLO1" 
							onmouseover="overOnInfo('CTLO1');"  onmouseout="outFromInfo('CTLO1');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=CTLO> colorful twingkle love</a></p>
					<p class="author">by Oda Aya</p>
					<p class="author">2 Pembaca</p>
					<p class="author">0 Rekomendasi</p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=BCA><img style="z-index:-1;" 
		onmouseout="hideInfo('BCA2')" 
		onmouseover="showInfo('BCA2', 'loaderBCA2','BCA')" 
		src="cover_small/BCA.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="BCA2" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('BCA2');"  onmouseout="outFromInfo('BCA2');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowBCA2"
								onmouseover="overOnInfo('BCA2');"  
								onmouseout="outFromInfo('BCA2');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderBCA2" 
							onmouseover="overOnInfo('BCA2');"  onmouseout="outFromInfo('BCA2');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=BCA>Bahwa Cinta itu Ada</a></p>
					<p class="author">by dermawan wibisono</p>
					<p class="author">0 Pembaca</p>
					<p class="author">1 Rekomendasi</p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=DVNP><img style="z-index:-1;" 
		onmouseout="hideInfo('DVNP3')" 
		onmouseover="showInfo('DVNP3', 'loaderDVNP3','DVNP')" 
		src="cover_small/DVNP.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="DVNP3" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('DVNP3');"  onmouseout="outFromInfo('DVNP3');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowDVNP3"
								onmouseover="overOnInfo('DVNP3');"  
								onmouseout="outFromInfo('DVNP3');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderDVNP3" 
							onmouseover="overOnInfo('DVNP3');"  onmouseout="outFromInfo('DVNP3');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=DVNP>Divine Puzzle</a></p>
					<p class="author">by Masahiro Uchida   Shinji Kimoto</p>
					<p class="author">2 Pembaca</p>
					<p class="author">1 Rekomendasi</p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=FTAK><img style="z-index:-1;" 
		onmouseout="hideInfo('FTAK4')" 
		onmouseover="showInfo('FTAK4', 'loaderFTAK4','FTAK')" 
		src="cover_small/FTAK.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="FTAK4" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('FTAK4');"  onmouseout="outFromInfo('FTAK4');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowFTAK4"
								onmouseover="overOnInfo('FTAK4');"  
								onmouseout="outFromInfo('FTAK4');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderFTAK4" 
							onmouseover="overOnInfo('FTAK4');"  onmouseout="outFromInfo('FTAK4');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=FTAK>Faster Than a Kiss</a></p>
					<p class="author">by Meca Tanaka</p>
					<p class="author">3 Pembaca</p>
					<p class="author">0 Rekomendasi</p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=GDT><img style="z-index:-1;" 
		onmouseout="hideInfo('GDT5')" 
		onmouseover="showInfo('GDT5', 'loaderGDT5','GDT')" 
		src="cover_small/GDT.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="GDT5" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('GDT5');"  onmouseout="outFromInfo('GDT5');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowGDT5"
								onmouseover="overOnInfo('GDT5');"  
								onmouseout="outFromInfo('GDT5');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderGDT5" 
							onmouseover="overOnInfo('GDT5');"  onmouseout="outFromInfo('GDT5');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=GDT>Godhand Teru</a></p>
					<p class="author">by Kazuki Yamamoto</p>
					<p class="author">27 Pembaca</p>
					<p class="author">1 Rekomendasi</p>
				</div>
			</div><div class="hline"></div><div class="boxlong">
			<p class="left"><a href=mostpopular.php>Most Popular</a></p>
		
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=DC><img style="z-index:-1;" 
		onmouseout="hideInfo('DC6')" 
		onmouseover="showInfo('DC6', 'loaderDC6','DC')" 
		src="cover_small/DC.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="DC6" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('DC6');"  onmouseout="outFromInfo('DC6');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowDC6"
								onmouseover="overOnInfo('DC6');"  
								onmouseout="outFromInfo('DC6');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderDC6" 
							onmouseover="overOnInfo('DC6');"  onmouseout="outFromInfo('DC6');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=DC>Detective Conan</a></p>
					<p class="author">by Aoyama Gosho</p>
					<p class="author">115 Pembaca</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=OPC><img style="z-index:-1;" 
		onmouseout="hideInfo('OPC7')" 
		onmouseover="showInfo('OPC7', 'loaderOPC7','OPC')" 
		src="cover_small/OPC.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="OPC7" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('OPC7');"  onmouseout="outFromInfo('OPC7');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowOPC7"
								onmouseover="overOnInfo('OPC7');"  
								onmouseout="outFromInfo('OPC7');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderOPC7" 
							onmouseover="overOnInfo('OPC7');"  onmouseout="outFromInfo('OPC7');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=OPC>One Piece</a></p>
					<p class="author">by Eiichiro Oda</p>
					<p class="author">65 Pembaca</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=NRT><img style="z-index:-1;" 
		onmouseout="hideInfo('NRT8')" 
		onmouseover="showInfo('NRT8', 'loaderNRT8','NRT')" 
		src="cover_small/NRT.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="NRT8" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('NRT8');"  onmouseout="outFromInfo('NRT8');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowNRT8"
								onmouseover="overOnInfo('NRT8');"  
								onmouseout="outFromInfo('NRT8');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderNRT8" 
							onmouseover="overOnInfo('NRT8');"  onmouseout="outFromInfo('NRT8');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=NRT>Naruto</a></p>
					<p class="author">by Masashi Kishimoto</p>
					<p class="author">53 Pembaca</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=CRS><img style="z-index:-1;" 
		onmouseout="hideInfo('CRS9')" 
		onmouseover="showInfo('CRS9', 'loaderCRS9','CRS')" 
		src="cover_small/CRS.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="CRS9" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('CRS9');"  onmouseout="outFromInfo('CRS9');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowCRS9"
								onmouseover="overOnInfo('CRS9');"  
								onmouseout="outFromInfo('CRS9');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderCRS9" 
							onmouseover="overOnInfo('CRS9');"  onmouseout="outFromInfo('CRS9');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=CRS>Crayon Shinchan</a></p>
					<p class="author">by Yoshito Usui</p>
					<p class="author">52 Pembaca</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=DRM><img style="z-index:-1;" 
		onmouseout="hideInfo('DRM10')" 
		onmouseover="showInfo('DRM10', 'loaderDRM10','DRM')" 
		src="cover_small/DRM.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="DRM10" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('DRM10');"  onmouseout="outFromInfo('DRM10');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowDRM10"
								onmouseover="overOnInfo('DRM10');"  
								onmouseout="outFromInfo('DRM10');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderDRM10" 
							onmouseover="overOnInfo('DRM10');"  onmouseout="outFromInfo('DRM10');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=DRM>Doraemon</a></p>
					<p class="author">by Fujiko F. Fujio</p>
					<p class="author">45 Pembaca</p>
					<p class="author"></p>
				</div>
			</div><div class="hline"></div><div class="boxlong">
			<p class="left"><a href=mostrecommended.php>Most Recommended</a></p>
		
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=DC><img style="z-index:-1;" 
		onmouseout="hideInfo('DC11')" 
		onmouseover="showInfo('DC11', 'loaderDC11','DC')" 
		src="cover_small/DC.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="DC11" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('DC11');"  onmouseout="outFromInfo('DC11');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowDC11"
								onmouseover="overOnInfo('DC11');"  
								onmouseout="outFromInfo('DC11');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderDC11" 
							onmouseover="overOnInfo('DC11');"  onmouseout="outFromInfo('DC11');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=DC>Detective Conan</a></p>
					<p class="author">by Aoyama Gosho</p>
					<p class="author">9 Rekomendasi</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=BRS><img style="z-index:-1;" 
		onmouseout="hideInfo('BRS12')" 
		onmouseover="showInfo('BRS12', 'loaderBRS12','BRS')" 
		src="cover_small/BRS.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="BRS12" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('BRS12');"  onmouseout="outFromInfo('BRS12');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowBRS12"
								onmouseover="overOnInfo('BRS12');"  
								onmouseout="outFromInfo('BRS12');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderBRS12" 
							onmouseover="overOnInfo('BRS12');"  onmouseout="outFromInfo('BRS12');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=BRS>Break Shot</a></p>
					<p class="author">by Takeshi Maekawa</p>
					<p class="author">6 Rekomendasi</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=BLC><img style="z-index:-1;" 
		onmouseout="hideInfo('BLC13')" 
		onmouseover="showInfo('BLC13', 'loaderBLC13','BLC')" 
		src="cover_small/BLC.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="BLC13" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('BLC13');"  onmouseout="outFromInfo('BLC13');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowBLC13"
								onmouseover="overOnInfo('BLC13');"  
								onmouseout="outFromInfo('BLC13');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderBLC13" 
							onmouseover="overOnInfo('BLC13');"  onmouseout="outFromInfo('BLC13');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=BLC>Bleach</a></p>
					<p class="author">by Tite Kubo</p>
					<p class="author">4 Rekomendasi</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=DPD><img style="z-index:-1;" 
		onmouseout="hideInfo('DPD14')" 
		onmouseover="showInfo('DPD14', 'loaderDPD14','DPD')" 
		src="cover_small/DPD.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="DPD14" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('DPD14');"  onmouseout="outFromInfo('DPD14');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowDPD14"
								onmouseover="overOnInfo('DPD14');"  
								onmouseout="outFromInfo('DPD14');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderDPD14" 
							onmouseover="overOnInfo('DPD14');"  onmouseout="outFromInfo('DPD14');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=DPD>Desperado</a></p>
					<p class="author">by Daiji Matsumoto</p>
					<p class="author">4 Rekomendasi</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=PGE><img style="z-index:-1;" 
		onmouseout="hideInfo('PGE15')" 
		onmouseover="showInfo('PGE15', 'loaderPGE15','PGE')" 
		src="cover_small/PGE.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="PGE15" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('PGE15');"  onmouseout="outFromInfo('PGE15');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowPGE15"
								onmouseover="overOnInfo('PGE15');"  
								onmouseout="outFromInfo('PGE15');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderPGE15" 
							onmouseover="overOnInfo('PGE15');"  onmouseout="outFromInfo('PGE15');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=PGE>Perfect Girl Evolution</a></p>
					<p class="author">by Tomoko Hayakawa</p>
					<p class="author">4 Rekomendasi</p>
					<p class="author"></p>
				</div>
			</div><div class="hline"></div><div class="boxlong">
			<p class="left"><a href=booksofthemonth.php>Books Of The Month</a></p>
		
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=OPC><img style="z-index:-1;" 
		onmouseout="hideInfo('OPC16')" 
		onmouseover="showInfo('OPC16', 'loaderOPC16','OPC')" 
		src="cover_small/OPC.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="OPC16" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('OPC16');"  onmouseout="outFromInfo('OPC16');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowOPC16"
								onmouseover="overOnInfo('OPC16');"  
								onmouseout="outFromInfo('OPC16');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderOPC16" 
							onmouseover="overOnInfo('OPC16');"  onmouseout="outFromInfo('OPC16');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=OPC>One Piece</a></p>
					<p class="author">by Eiichiro Oda</p>
					<p class="author">8 Pembaca Bulan Ini</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=DBT><img style="z-index:-1;" 
		onmouseout="hideInfo('DBT17')" 
		onmouseover="showInfo('DBT17', 'loaderDBT17','DBT')" 
		src="cover_small/DBT.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="DBT17" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('DBT17');"  onmouseout="outFromInfo('DBT17');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowDBT17"
								onmouseover="overOnInfo('DBT17');"  
								onmouseout="outFromInfo('DBT17');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderDBT17" 
							onmouseover="overOnInfo('DBT17');"  onmouseout="outFromInfo('DBT17');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=DBT>Doubt</a></p>
					<p class="author">by Yoshiki Tonogai</p>
					<p class="author">3 Pembaca Bulan Ini</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=GDT><img style="z-index:-1;" 
		onmouseout="hideInfo('GDT18')" 
		onmouseover="showInfo('GDT18', 'loaderGDT18','GDT')" 
		src="cover_small/GDT.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="GDT18" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('GDT18');"  onmouseout="outFromInfo('GDT18');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowGDT18"
								onmouseover="overOnInfo('GDT18');"  
								onmouseout="outFromInfo('GDT18');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderGDT18" 
							onmouseover="overOnInfo('GDT18');"  onmouseout="outFromInfo('GDT18');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=GDT>Godhand Teru</a></p>
					<p class="author">by Kazuki Yamamoto</p>
					<p class="author">3 Pembaca Bulan Ini</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=THG><img style="z-index:-1;" 
		onmouseout="hideInfo('THG19')" 
		onmouseover="showInfo('THG19', 'loaderTHG19','THG')" 
		src="cover_small/THG.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="THG19" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('THG19');"  onmouseout="outFromInfo('THG19');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowTHG19"
								onmouseover="overOnInfo('THG19');"  
								onmouseout="outFromInfo('THG19');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderTHG19" 
							onmouseover="overOnInfo('THG19');"  onmouseout="outFromInfo('THG19');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=THG>The Hunger Game</a></p>
					<p class="author">by UNKNOWN</p>
					<p class="author">2 Pembaca Bulan Ini</p>
					<p class="author"></p>
				</div>
			
				<div style=";border:0px solid black; float:left;">
	<a href=wikibook.php?bookcode=KKBB><img style="z-index:-1;" 
		onmouseout="hideInfo('KKBB20')" 
		onmouseover="showInfo('KKBB20', 'loaderKKBB20','KKBB')" 
		src="cover_small/KKBB.jpg" width="90px" height="120px" class="mainpic"></a>
					<div id="KKBB20" 
						style="
							//display:block;
							display:none;
							background-color:blue;
							position:absolute;
							//left:0px;
							//z-index:0;
							//width:100px;
							//height:50px;
							//border:1px solid green
							text-align:center;">
						<div
							onmouseover="overOnInfo('KKBB20');"  onmouseout="outFromInfo('KKBB20');" 
							style="
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;">
							<div 
								id="arrowKKBB20"
								onmouseover="overOnInfo('KKBB20');"  
								onmouseout="outFromInfo('KKBB20');" 
							
							style="
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									">
								</div>
				<table style="position:absolute;top:10px;" border="0px" cellpadding="0" cellspacing="0" width="100%">	
					<tr>
								<td height="10px";>
									<div style="position:absolute">
										<div style="top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;"></div>
									</div>
								</td>
							</tr>
					<tr>
						<td width="10px" style="
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							">
									<!--left blend;-->
									
						</td>
						<td>
							<div id="loaderKKBB20" 
							onmouseover="overOnInfo('KKBB20');"  onmouseout="outFromInfo('KKBB20');" 
							style="background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;">
								<img src="images/ajax-loading.gif" height="150px">
								
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style="height:10px; ">
								<td>
									<div style="position:absolute">
										<div style="top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										"></div>
									</div>
								</td>
							</tr>
				</table>
						</div>
					</div>
	<p class="title"><a href=wikibook.php?bookcode=KKBB>kuroko basketball</a></p>
					<p class="author">by tadatoshi fujimaki</p>
					<p class="author">2 Pembaca Bulan Ini</p>
					<p class="author"></p>
				</div>
			</div>		</div>
		<div style="border:0px solid black;float:left;
			//width:142px;"
		></div>
		
		<div class="mfooter">
			<div style="
				//border:1px solid red;
				display:table;
				margin:0px auto;
				width:900px;
			">
				<img style="
					float:left;
					" src="images/airabooks.png" width="100px">
				<div style="
					//border-bottom:0px solid #c2c2c2;
					//border:1px solid black;
					width:auto;
					float:left;
					margin:15px 0 0 15px;
				">
					<a href=# class="style3">About</a>
					<a href=# class="style3">Staff</a>
					<a href=# class="style3">Pembelian</a>
					<a href=# class="style3">Kritik dan Saran</a>
					<a href=# class="style3">Bantuan</a>
				</div>
			<div style="
					display:table;
					border-top:1px solid #c2c2c2;
					
					//border:1px solid black;
					width:780px;
					height:1px;
					float:left;
					//margin:15px 0 0 0;
					padding:0;
				">
				<div id="fb_container_footer" style="position:relative;
					//left:-70px;
					float:left;
					display:none;
					//right:40px;	
					//top:2px;
					width:600px;
				height:40px;
					border:1px solid red;
				">
				<!--<fb:login-button style="border:0px solid black; 
					margin-top:0px;" show-faces="true" width="600" max-rows="1"></fb:login-button>-->
				</div>

				<div style="
					
					//border:1px solid black;
					width:auto;
					float:right;
					//margin:10px 25px 0 0;
				">
					<span style="
						
						font-family:'Verdana';
						font-size:14px;
						font-weight:normal;
						color:#222299;
					">
						airabooks &copy; 2013
					</span>
				</div>
			</div>
		</div>
		</div>	</div>
	</body>
</html>

