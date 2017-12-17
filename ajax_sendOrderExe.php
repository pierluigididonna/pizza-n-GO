<?php
	session_start();
	
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	$date = $_POST['date'];
	$idOrder = $_POST['idOrder'];
	$orderType = $_POST['orderType'];
	$dateSelected = $_POST['dateSelected'];
	$username = $_SESSION['username'];
	
	$sql = "INSERT INTO EFFETTUA (DATA_E,DATA_R,TIPO_ORD,LOGIN,ID_ORDINE) VALUES ('$date','$dateSelected','$orderType','$username','$idOrder')";
	
	mysqli_query($conn,$sql);
	
	mysqli_close($conn);
?>