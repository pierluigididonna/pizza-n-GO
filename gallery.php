<?php
	require_once("config.php");
	require_once("funzioni.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
			<li> <a id = "active" href="gallery.php">Galleria</a></li>
			<li> <a href="contacts.php">Contatti</a></li>
			<li class="right"> <a href="login.php"><i class="fa fa-user-circle fa-lg"></i></a></li>
			</li>
		</ul>
		
		<div class="verticalLine">
			<div class="mainpage">
				<div class="mainContainer">
					<h2 class = "Category">Galleria</h2>
					<?php
						$lista_file = caricaDirectory(DIR_IMMAGINI);
						if(count($lista_file)>0){
						echo "<table id = 'galleryTable'>\n",
						"\t<tr>\n",
						"\t\t<td>",
						generaLinkImmagine(0, $lista_file[0]),
						"</td>\n";
						for ($i = 1;$i<count($lista_file); $i++){
							if($i % $immagini_per_riga == 0)
								echo "\t</tr>\n\t<tr>\n";
							echo "\t\t<td>",
							generaLinkImmagine($i, $lista_file[$i]),
							"</td>\n";
						}
						echo "\t</tr>\n",
						"</table>\n";
						}
					?>
				</div>
			</div>
		</div>	
	</article>
	<script>
		$(document).ready(function(){
			$("img").click(function(){
				var img = $(this).attr("src");
				var appear_image = "<div id='appear_image_div'></div>";
				appear_image = appear_image.concat("<img id='appear_image' src='"+img+"' />");
				appear_image = appear_image.concat("<div id='closebutton' onClick='closeImage()'><i class='fa fa-close fa-2x'></i></div>");
				$('body').append(appear_image);
			});
		});
		function closeImage(){
			$('#appear_image_div').remove();
			$('#appear_image').remove();
			$('#closebutton').remove();
		}
	</script>
<footer>
	<small> ©2017 Pizza'n GO! </small>
</footer>
</body>
</html>