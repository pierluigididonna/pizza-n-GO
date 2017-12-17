<?php 
	include('server.php');
	if(empty($_SESSION['username']) || strtolower($_SESSION['username']) == 'admin') {
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
	}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
		</ul>
	</aside>
	
	<article class="column middle">
		<ul class="topnav">
			<li class="dropdown">
				<button class="dropbtn"><i class="fa fa-user-circle fa-lg"></i></button>
					<div class="dropdown-content">
						<a href="#"><?php echo ucfirst(strtolower($_SESSION['username'])); ?></a>
						<a href="#">I Miei Ordini</a>
						<a href="client.php?logout='1'">Logout</a>
					</div>
			</li>
			<li class="right"> <a href="#"><i class="fa fa-question-circle fa-lg"></i></a></li>
		</ul>
			
		<div class="mainpage">
			<div class= "leftColumn">
				
				<h2 class = "Category"> PIZZE </h2>
				
				<?php
					$sql = "SELECT NOME_P FROM PRODOTTO WHERE CATEGORIA = 'PIZZE'";
					$result = mysqli_query($conn,$sql);
					
					while($row = mysqli_fetch_array($result)) { ?>
						<div class="leftContainer" id = "<?php echo $row["NOME_P"]; ?>">
							<i class = "material-icons"> local_pizza </i>
							<p class = "productName"> <?php echo $row["NOME_P"]; ?> </p>
							<input type="button" name="<?php echo $row["NOME_P"]; ?>" class="ordina" value="Ordina" />
						</div>
				<?php } ?>
				
				<h2 class = "Category"> BEVANDE </h2>
				
				<?php
					$sql = "SELECT NOME_P FROM PRODOTTO WHERE CATEGORIA = 'BEVANDE'";
					$result = mysqli_query($conn,$sql);
					
					while($row = mysqli_fetch_array($result)) { ?>
						<div class="leftContainer" id = "<?php echo $row["NOME_P"]; ?>">
							<i id = "font-awesome" class="fa fa-beer fa-lg"> </i>
							<p class = "productName"> <?php echo $row["NOME_P"]; ?> </p>
							<input type="button" name="<?php echo $row["NOME_P"]; ?>" class="ordina" value="Ordina" />
						</div>
				<?php } ?>
			</div>

			<div class="rightContainer">
				<h2 class = "Category"> ORDINE </h2>
				<hr>
				<div id = "pizzeList">
					<table id = "tablePizza">
						<tbody>
						</tbody>
					</table>
				</div>
				<hr style = "margin-bottom: 5px;">
				<?php
					$start = "18:00";
					$end = "23:30";

					$tStart = strtotime($start);
					$tEnd = strtotime($end);
					$tNow = $tStart;
					$currentTime = strtotime(date('H:i')); 

					while ($tNow <= strtotime('+60 minutes',$currentTime)){
						$tNow = strtotime('+30 minutes',$tNow);
					}
				?>
				<div id = "timeContainer">
					<select id = "orderTime">
						<?php	while($tNow <= $tEnd){ ?>
							<option>
							<?php echo date("H-i",$tNow); ?>
							</option>
							<?php
							  $tNow = strtotime('+30 minutes',$tNow);
							}
						?>
					</select>
				</div>
				<div id = "orderTypeContainer">
					<input type="radio" class="orderType" name="orderType" value="Asporto" checked="checked">  Asporto<br>
	  				<input type="radio" class="orderType" name="orderType" value="Domicilio">  Domicilio
				</div>
				<h3 class = "Category"><i> PREZZO TOTALE </i></h3>
				<div id = "prizeContainer"> </div>
				<input type="button" name="inviaOrdine" class="inviaOrdine" value="Invia" />
				<input type="button" name="reset" class="reset" value="Reset" />
			</div>
		</div>
	</article>

<script>
	$(document).ready(function(){
		$(".dropbtn").click(function(){
			$(".dropdown-content").toggle(500);
		});

		$(".ordina").click(function(){
			var name = $(this).attr("name");
			$('#tablePizza > tbody:last-child').append("<tr class = 'pizzaContainer'><td class = 'pizzeOrdine'>"+name+"</td><td class = 'pizzeOrdine'><select name='quantity' class ='quantity' onchange = 'aggiornaPrezzo()'><?php for($i=1;$i<=15;$i++):?><option value='<?php echo $i;?>'><?php echo $i;?></option><?php endfor;?></select></td></tr>");
			$(this).prop('disabled', true);
			$(this).css({'background-color':'grey','cursor':'default'});
			aggiornaPrezzo();
		});

		$(".reset").click(function(){
			$(".pizzaContainer").remove();
			$(".ordina").prop('disabled', false);
			$(".ordina").css({'background-color':'blue','cursor':'pointer'});
			document.getElementById("prezzoTot").innerHTML = "";
			document.getElementById("euro").innerHTML = "";
		});

		$(".inviaOrdine").click(function(){
			var table = $("table tbody");
			var xhttp = new XMLHttpRequest();
			var date = new Date();
			var error = "Inserire un Ordine!";
			var currentDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + date.getHours() + "-" + date.getMinutes() + "-" + date.getSeconds();
			var $idOrder;
			var $orderType = $("input:checked").val();
			var orderTimeSelected = $( "#orderTime option:selected" ).text();
			var dateSelected = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + orderTimeSelected;

			if (table.children().length == 0) {
				alert("Inserire un ordine valido!");
			}else{
				var prezzoTot = Number(document.getElementById("prezzoTot").innerHTML);
				xhttp.onreadystatechange = function() {
			       	if (this.readyState == 4 && this.status == 200) {
						$idOrder = Number(this.responseText);
			        }
			    };
			    xhttp.open("POST", "ajax_idOrder.php", false);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    xhttp.send("prezzoTot="+prezzoTot);

				table.find('tr').each(function (i) {
					var $tds = $(this).find('td'),
						pizza = $tds.eq(0).text(),
						quantity = $tds.eq(1).find(":selected").text();

					xhttp.onreadystatechange = function() {
				       	if (this.readyState == 4 && this.status == 200) {
							console.log('Table Row OK!');
				        }
				    };
				    xhttp.open("POST", "ajax_sendOrderCom.php", false);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				    xhttp.send("pizza="+pizza+"&quantity="+quantity+"&idOrder="+$idOrder);
				});

				xhttp.onreadystatechange = function() {
			       	if (this.readyState == 4 && this.status == 200) {
						console.log('Order OK!');
			        }
			    };
			    xhttp.open("POST", "ajax_sendOrderExe.php", false);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    xhttp.send("date="+currentDate+"&idOrder="+$idOrder+"&orderType="+$orderType+"&dateSelected="+dateSelected);

				$(".pizzaContainer").remove();
				$(".ordina").prop('disabled', false);
				$(".ordina").css({'background-color':'blue','cursor':'pointer'});
				document.getElementById("prezzoTot").innerHTML = "";
				document.getElementById("euro").innerHTML = "";
			}
		});
	});

	function aggiornaPrezzo(){
		var prezzoTot = 0;
		var table = $("table tbody");
		var xhttp = new XMLHttpRequest();

		table.find('tr').each(function (i) {
			var $tds = $(this).find('td'),
				pizza = $tds.eq(0).text(),
				quantity = $tds.eq(1).find(":selected").text();

			xhttp.onreadystatechange = function() {
		       	if (this.readyState == 4 && this.status == 200) {
					var prize = (Number(this.responseText)*Number(quantity));
					prezzoTot = Number(prezzoTot)+Number(prize);
				}	
		    };
		    xhttp.open("POST", "ajax_pizzaPrize.php", false);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("pizza="+pizza);
		});
		document.getElementById("prizeContainer").innerHTML = "<p id = 'prezzoTot'>"+prezzoTot+"</p><p id = 'euro'> €</p>";
	}
</script>

<footer>
	<small> ©2017 Pizza'n GO! </small>
</footer>
</body>
</html>