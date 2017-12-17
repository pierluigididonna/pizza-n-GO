<?php
	session_start();
	
	$nome = "";
	$cognome = "";
	$città = "";
	$via = "";
	$telefono = "";
	$login = "";
	$password = "";
	$errors = array();
	
	$conn = mysqli_connect('localhost', 'root', '');
	
	if (!$conn){
		echo "Errore nella connessione al Server";
	}
	
	if (!mysqli_select_db($conn, 'test')){
		echo "Errore nella selezione del Database";
	}
	
	
	if(ISSET($_POST['register'])){
		$nome = $_POST["nome"];
		$cognome = $_POST['cognome'];
		$città = $_POST['città'];
		$via = $_POST['via'];
		$telefono = $_POST['telefono'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(empty($nome)){
			array_push($errors, "Il campo 'Nome' è obbligatorio");
		}
		
		if(empty($cognome)){
			array_push($errors, "Il campo 'Cognome' è obbligatorio");
		}
		
		if(empty($via)){
			array_push($errors, "Il campo 'Via' è obbligatorio");
		}
		
		if(empty($telefono)){
			array_push($errors, "Il campo 'Telefono' è obbligatorio");
		}
		
		if(empty($username)){
			array_push($errors, "Il campo 'Nome Utente' è obbligatorio");
		}
		
		$sql = "SELECT * FROM UTENTE WHERE LOGIN='$username'";
		$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) == 1){
				array_push($errors, "Username già esistente!");
			}
		
		if(empty($password)){
			array_push($errors, "Il campo 'Password' è obbligatorio");
		}
		
		if (count($errors) == 0){
			$sql = "INSERT INTO UTENTE (NOME,COGNOME,CITTA,VIA,TELEFONO,LOGIN,PASSWORD) 
				VALUES ('$nome','$cognome','$città','$via','$telefono','$username','$password')";
			
			mysqli_query($conn,$sql);
			header('location: login.php');
		}
	}
	
	if(isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(empty($username)){
			array_push($errors, "Il campo 'Nome Utente' è obbligatorio");
		}
		
		if(empty($password)){
			array_push($errors, "Il campo 'Password' è obbligatorio");
		}
		
		if (count($errors) == 0){
			$sql = "SELECT * FROM UTENTE WHERE LOGIN='$username' AND PASSWORD='$password'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) == 1){
				$_SESSION['username'] = strtolower($username);
				if (strtolower($username) == 'admin'){
					header('location: admin.php');
				}else{
					header('location: client.php');
				}
			}else{
				array_push($errors, "Username o Password errati");
			}
		}
	}
	
	if(isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: index.php');
	}
?>