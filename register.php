<?php include ('server.php'); ?>
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
	<div>
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
				<li> <a href="contacts.php">Contatti</a></li>
				<li class="right"> <a id = "active" href="login.php"><i class="fa fa-user-circle fa-lg"></i></a></li>
				</li>
			</ul>
			
			<div class="verticalLine"> 
				<div class="mainpage">
				
				<div class="mainContainer">
				
					<img id = "userLogo" src="/icon/userlogo.png" alt="userlogo">
				
					<p style = "text-align: center; margin-bottom: 20px;"><i>Crea un profilo 'Pizza'n GO!'<br />
					Registrati per gestire velocemente e facilmente i tuoi ordini!
					</i></p>
					
					<form action="/register.php" method="POST">
					
						<?php include('errors.php'); ?>
					
						<label for="nome">Nome</label>
						<input type="text" id="nome" name="nome" placeholder="Nome...">

						<label for="cognome">Cognome</label>
						<input type="text" id="cognome" name="cognome" placeholder="Cognome...">

						<label for="città">Città</label>
						<select id="città" name="città">
							<option value="torredelgreco">Torre del Greco</option>
							<option value="ercolano">Ercolano</option>
							<option value="portici">Portici</option>
						</select>
						
						<label for="via">Via</label>
						<input type="text" id="via" name="via" placeholder="Via...">
						
						<label for="telefono">Telefono</label>
						<input type="number" id="telefono" name="telefono" placeholder="Telefono...">
						
						<label for="username">Nome Utente</label> <p style = "color: red;" id = "userError"> </p>
						<input type="text" onBlur = "userError()" id="username" name="username" placeholder="Nome Utente...">
						
						<label for="password">Password</label>
						<input autocomplete = "off" type="password" id="password" name="password" placeholder="Password..." autocomplete = "new-password">
						
						<div style = "text-align: center">
							<input type="submit" name="register" value="Registrati">
						</div>
					</form>
				</div>
					<p style="text-align: center; margin-top: 10px;margin-bottom: 20px;"><i> Sei già registrato? <b><a href="login.php">Accedi!<a></b></i></p>
				</div>
			</div>
		</article>
		
		<script>
			function userError(){
			    var xhttp = new XMLHttpRequest();
				var username = document.getElementById('username').value;
				
			    xhttp.onreadystatechange = function() {
			        if (this.readyState == 4 && this.status == 200) {
			            document.getElementById("userError").innerHTML = this.responseText;
			        }
			    };
			    xhttp.open("POST", "ajax_user.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    xhttp.send("username="+username);
			}
		</script>
		<footer>
				<small> ©2017 Pizza'n GO! </small>
		</footer>
	</div>
</body>
</html>