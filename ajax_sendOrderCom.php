<?php
	$conn = mysqli_connect('localhost', 'root', '');

	if (!$conn){
		echo "Errore nella connessione al Server";
	}

	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}

	$pizza = $_POST['pizza'];
	$quantity = $_POST['quantity'];
	$idOrder = $_POST['idOrder'];

	$sql = "INSERT INTO COMPRENDE (QUANTITA,ID_ORDINE,NOME_P) VALUES ('$quantity','$idOrder','$pizza')";

	mysqli_query($conn,$sql);

	mysqli_close($conn);
?>