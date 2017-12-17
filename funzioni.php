<?php

function caricaDirectory($dir) {

//La funzione opendir() apre la cartella specificata come parametro e mette in $dh la risorsa
//per la sua manipolazione. Se l'operazione non ha successo viene eseguita l'istruzione die().
	$dh = opendir($dir)  
		or die("Errore nell'apertura della directory ". $dir);
//Viene creato un array() inizialmente vuoto chiamato $contenuto, che verrà poi utilizzato per
//contenere i file di tipo immagine che si trovano nella cartella precedentemente aperta.
	$contenuto = array();
//il nome di ciascun file viene letto tramite il ciclo while; l'istruzione readdir() legge un singolo
//elemento della directory e lo memorizza nella variabile $file e restituisce il valore FALSE quando
//sono terminati gli elementi. (!== è un operatore di disequivalenza, ssia verifica se i due valori
//sono diversi o hanno tipo diverso.
	while (($file = readdir ($dh)) !== FALSE)
//per ogni file aperto l'if verifica che non sia una directory con !is_dir() e che l'estensione del
//file sia quella di un immagine. Questo controllo viene affidato ad un altra funzione, chiamata 
//controllaFormato(). Il file viene poi memorizzato all'interno dell'array $contenuto.
		if (!is_dir($file) && controllaFormato($file))
			$contenuto[] = $file;
//viene infine chiusa la directory e restituito l'array.
	closedir($dh);
	return $contenuto;
}

function controllaFormato($nomefile) {
//Con il costrutto global si identifica una variabile che si vuole prelevare dal contesto globale
//del file. Viene quindi richiamato l'array formati_immagine che contiene le estensioni possibili
//dei file immagine.
	global $formati_immagine;
//Il ciclo foreach permette l'attraversamento degli elementi di un array. Il ciclo si ripete tante
//volte quanti sono gli elementi presenti nell'array (espressione del primo argomento) e viene 
//memorizzato nella variabile presente come secondo argomento (in questo caso $formato) il valore
//dell'elemento corrispondente all'iterazione
	foreach ($formati_immagine as $formato)
//la funzione strrpos restituisce (al contrario della funzione strpos) la posizione dell'ultima
//occorrenza della stringa del secondo argomento all'interno della stringa del primo argomento
//restituendo FALSE ne caso in cui non vi sia alcuna occorrenza. Quindi se la stringa formato
//viene trovata all'interno della stringa $nomefile viene restituito TRUE altrimenti FALSE.
		if (strrpos($nomefile, $formato) !== FALSE)
			return TRUE;
		return FALSE;
}

//Questa funzione è identica alla precedente solo che controlla il tipo del file $nomefile e non
//il formato.
function controllaTipo($nomefile) {
	global $tipi_immagine;
	foreach ($tipi_immagine as $tipo)
		if (strrpos($nomefile, $tipo) !== FALSE)
			return TRUE;
		return FALSE;
}

//Le seguenti funzioni servono a generare il testo di un collegamento alla pagina visualizza.php 
//corrispodente alla visualizzazione dell'immagine il cui indice è passato come parametro.
//La differenza sta nel tipo di contenuto del link. Nel primo caso è un immagine, nel secondo
//è il testo passato come parametro.

function generaLinkImmagine($indice_immagine, $file) {
	return "<img id='myImg' class='imageGallery' src=\"" . DIR_IMMAGINI . "/". $file . "\"/>";
}
?>