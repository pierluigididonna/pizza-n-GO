<?php
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	$idOrder = $_POST['idOrder'];
	
	$sql = "UPDATE ORDINE SET ORDER_CHECK = '1' WHERE ID_ORDINE = '$idOrder'";
	
	mysqli_query($conn,$sql);
	
	mysqli_close($conn);
?>