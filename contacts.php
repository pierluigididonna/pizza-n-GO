<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" type="image/png" href="/icon/pizzalogo.png">
	<title> Pizza'n GO! </title>
</head>
<body>

	<aside class="column side">
		<div class="aside">
			<img id = "mainLogo" src="/immagini/pizzalogo.png" alt="Logo">
			<h2>Pizza'n GO!</h2>
		</div>
		<hr>
		<ul class="socialLink">
			<li> <a href="http:\\www.facebook.it" target=”_blank”><i class="fa fa-facebook fa-2x"></i></a></li>
			<li> <a href="http:\\instagram.com" target=”_blank”><i class="fa fa-instagram fa-2x"></i></a></li>
			<li> <a href="http:\\tripadvisor.it" target=”_blank”><i class="fa fa-tripadvisor fa-2x"></i></a></li>
			</li>
		</ul>
	</aside>
	
	<article class="column middle">
		<ul class="topnav">
			<li> <a href="index.php">Home</a></li>
			<li> <a href="gallery.php">Galleria</a></li>
			<li> <a id = "active" href="contacts.php">Contatti</a></li>
			<li class="right"> <a href="login.php"><i class="fa fa-user-circle fa-lg"></i></a></li>
			</li>
		</ul>
		
		<div class="verticalLine">
			<div class="mainpage">
				<div class="mainContainer">
					<h2 class = "Category">Dove Siamo?</h2>
					<p><strong>Pizza'n GO!</strong></p>
					<p><i><a href="mailto:info@pizzango.it">info@pizzango.it</a></i></p>
					<p><i>Tel: 081849****</i></p>
					<p><i>Torre del Greco</i></p>
					<p><i>Via Roma - 30</i></p>
					
					<div id="googleMap"></div>

					<script>
						function myMap() {
							var mapProp= {
								center:new google.maps.LatLng(40.7890403,14.3679614),
								zoom:18,
							};
							var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
							var marker = new google.maps.Marker({
								position: mapProp.center,
								animation: google.maps.Animation.BOUNCE
							});
							marker.setMap(map);
							google.maps.event.addListener(marker,'click',function() {
								var infowindow = new google.maps.InfoWindow({
									content:"Pizza'n GO!"
								});
								infowindow.open(map,marker);
							});
						}
					</script>

					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiseLKCr6bdiBkWl-4kto8p1K7yt2N97o&callback=myMap"></script>
				</div>
			</div>
		</div>
	</article>
<footer>
	<small> ©2017 Pizza'n GO! </small>
</footer>
</body>
</html>