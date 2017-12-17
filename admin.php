<?php 
	include('server.php');
	if(strtolower($_SESSION['username']) != 'admin' ) {
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
	<ul class="topnav">
		<li class="dropdown">
			<button class="dropbtn"><i class="fa fa-user-circle fa-lg"></i></button>
				<div class="dropdown-content">
					<a href="#">???</a>
					<a href="#">???</a>
					<a href="admin.php?logout='1'">Logout</a>
				</div>
		</li>
		<li class="right"> <a href="#"><i class="fa fa-question-circle fa-lg"></i></a></li>
	</ul>

	<div class = "leftSide">
		<?php
			$sql = "SELECT O.ID_ORDINE,E.LOGIN,E.TIPO_ORD,E.DATA_R,O.ORDER_CHECK FROM ORDINE O JOIN EFFETTUA E ON O.ID_ORDINE = E.ID_ORDINE WHERE ORDER_CHECK IS NULL ORDER BY E.DATA_R";
			$result = mysqli_query($conn,$sql);
		?>
		<table class = "orderTableAdmin" id = "orderListTable">
			<tbody>
				<tr>
					<th>ID_ORDINE</th>
					<th>CLIENTE</th>
					<th>DATA</th>
					<th>TIPO</th>
					<th>INFO</th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result)) { ?>
					<tr id = "<?php echo $row["ID_ORDINE"]; ?>">
						<td> <?php echo $row["ID_ORDINE"]; ?> </td>
						<td> <button class = "viewInfo" name = "<?php echo ucfirst(strtolower($row["LOGIN"])); ?>"><?php echo ucfirst(strtolower($row["LOGIN"])); ?><div id = "<?php echo ucfirst(strtolower($row["LOGIN"])); ?>" class="dropdown-user-content"></div></button></td>
						<td> <?php echo $row["DATA_R"]; ?> </td>
						<td> <?php echo $row["TIPO_ORD"]; ?> </td>
						<td> <button id = "<?php echo $row["ID_ORDINE"]; ?>" class = "accettaOrdine" name = "<?php echo $row["ID_ORDINE"]; ?>"><i id = "infoCircle" class="fa fa-info-circle"></i></button></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<div class = "rightSide">

		<table class = "orderTableAdmin" id = "orderPizzaTable">
			<tbody>
			</tbody>
		</table>
		
		<p id = "prizeButtonContainer"> </p>
		
	</div>

<script>
	$(document).ready(function(){
		$(".dropbtn").click(function(){
			$(".dropdown-content").toggle(500);
		});

		$(".accettaOrdine").click(function(){
			
			$(".accettaOrdine").prop('disabled', false);
			$(".accettaOrdine").css({'background-color':'blue','cursor':'pointer'});
			$('#orderPizzaTable > tbody').empty();
			
			var $idOrder = Number($(this).attr("name"));
			
			$.ajax({
				type: "POST",
				url: 'ajax_viewOrder.php',
				dataType: 'json',
				data: {
					idOrder: $idOrder
				},
				success: function(json) {
					var nome_array = json.nome_p;
					var quantita_array  = json.quantita;
					var prezzoTot = json.prezzo;
					
					$('#orderPizzaTable > tbody:last-child').append("<tr><th>PIZZA</th><th>QUANTITA'</th></tr>");

					for (x in nome_array) {
						$('#orderPizzaTable > tbody:last-child').append("<tr><td>"+nome_array[x]+"</td><td>"+quantita_array[x]+"</td></tr>");
			        }
					document.getElementById("prizeButtonContainer").innerHTML = "<div id = 'ordineTotale'>PREZZO TOTALE</div><h3>"+prezzoTot+" €</h3><button class = 'confermaOrdine' name = '"+$idOrder+"' onclick = 'confermaOrdine()'>CONFERMA ORDINE</button>";
				}
			});

			$(this).prop('disabled', true);
			$(this).css({'background-color':'grey','cursor':'default'});
		});
		
		$(".viewInfo").mouseover(function(event){
			var $username = $(this).attr("name");
			
			$.ajax({
				type: "POST",
				url: 'ajax_viewInfo.php',
				dataType: 'json',
				data: {
					username: $username
				},
				success: function(json) {
					var citta = json.citta;
					var via  = json.via;
					var telefono = json.telefono;
					
					$(event.target).children().html("<p> Città: "+citta+"</p><br><p> Via: "+via+"</p><br><p> Telefono: "+telefono+"</p>");
					$(event.target).children().show();
				}
			});
		});

		$(".viewInfo").mouseout(function(){
			var $username = $(this).attr("name");
			$(event.target).children().hide();
		});
	});

	function confermaOrdine(){
		var $idOrder = $(".confermaOrdine").attr("name");
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function() {
	       	if (this.readyState == 4 && this.status == 200) {
				console.log('Order Complete!');
			}	
	    };
	    xhttp.open("POST", "ajax_completeOrder.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("idOrder="+$idOrder);
		
		$('#orderPizzaTable > tbody').empty();
		$("#prizeButtonContainer").empty();
		$("#"+$idOrder).remove();
	}
</script>

<footer>
	<small> ©2017 Pizza'n GO! </small>
</footer>
</body>
</html>