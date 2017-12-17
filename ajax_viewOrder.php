<?php
	$conn = mysqli_connect('localhost', 'root', '');

	if (!$conn){
		echo "Errore nella connessione al Server";
	}

	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}

	$idOrder = $_POST['idOrder'];

	$sql = "SELECT NOME_P, QUANTITA FROM ORDINE O JOIN COMPRENDE C ON O.ID_ORDINE=C.ID_ORDINE WHERE O.ID_ORDINE = '$idOrder'";

	$result = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_array($result)) {
		$nome_p_array[] = $row['NOME_P'];
        $quantita_array[] = $row['QUANTITA'];
	}
	
	$sql = "SELECT PREZZO_O FROM ORDINE WHERE ID_ORDINE = '$idOrder'";
	
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_array($result);

	$prezzo = $row['PREZZO_O'];

	$response = array(
		'nome_p' => $nome_p_array,
		'quantita'  => $quantita_array,
		'prezzo' => $prezzo
		);

	echo json_encode($response);

	mysqli_close($conn);
?>