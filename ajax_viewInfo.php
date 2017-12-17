<?php
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	$username = $_POST['username'];
	
	$sql = "SELECT CITTA,VIA,TELEFONO FROM UTENTE WHERE LOGIN = '$username'";
	
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_array($result);
	
	$response = array(
		'citta' => $row['CITTA'],
		'via'  => $row['VIA'],
		'telefono' => $row['TELEFONO']
		);

	echo json_encode($response);
	
	mysqli_close($conn);
?>