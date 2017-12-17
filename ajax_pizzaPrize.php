<?php
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	$pizza = $_POST['pizza'];
	
	$sql = "SELECT PREZZO_P FROM PRODOTTO WHERE NOME_P = '$pizza'";
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_array($result);
	
	echo $row["PREZZO_P"];
	
	mysqli_close($conn);
?>