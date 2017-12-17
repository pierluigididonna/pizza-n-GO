<?php
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	$prezzoTot = $_POST['prezzoTot'];
	
	$sql = "INSERT INTO ORDINE (PREZZO_O) VALUES ('$prezzoTot')";
	
	mysqli_query($conn,$sql);
	
	$sql = "SELECT MAX(ID_ORDINE) FROM ORDINE";
	
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_array($result);
	
	echo $row["MAX(ID_ORDINE)"];
	
	mysqli_close($conn);
?>