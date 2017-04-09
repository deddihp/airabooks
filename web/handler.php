<?
echo "
<script type=\"text/javascript\">
window.fbAsyncInit = function() {
    FB.init({
        appId  : '159457617553432',
        status : true, // check login status
        cookie : true, // enable cookies to allow the server to access the session
        xfbml  : true  // parse XFBML
    });

    /* All the events registered */
    FB.Event.subscribe('comments.add', function (response) {
        // do something with response
        alert(\"comment added\");
    });

	FB.Event.subscribe('edge.create', function(href, widget) {
     		alert('like bl abl ablabla '+href);
   			console.log('lie lisdlfiasdlifsalidf' + href);
		});
   		FB.Event.subscribe('edge.remove', function(href, widget) {
     		alert('dislike '+href);
			console.log('unlike blabla ' + href);
   		});
};

(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/fi_FI/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());
</script>
";
?>
