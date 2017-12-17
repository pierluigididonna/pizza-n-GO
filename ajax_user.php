<?php
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	$username = $_POST['username'];
	
	$sql = "SELECT * FROM UTENTE WHERE LOGIN = '$username'";
	$result = mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result) == 1){
		echo "(* Username già esistente!)";
	}else{
		echo "";
	}
	
	mysqli_close($conn);
?>