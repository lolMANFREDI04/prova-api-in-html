<?php

$host = "localhost"; // Modifica questo con l'host del tuo database
$username = "root"; // Modifica questo con il tuo nome utente del database
$password = ""; // Modifica questo con la tua password del database
$dbname = "prova"; // Modifica questo con il nome del tuo database

// Effettua la connessione
$con = mysqli_connect($host, $username, $password, $dbname);

// Verifica della connessione
if (!$con) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Parametri della richiesta
$tableId = intval($_GET['table']); //$tableId = 1;
$page = intval($_GET['_page']); //$page = 1;
$limit = intval($_GET['_limit']); //$limit = 3;

// Calcola l'offset in base alla pagina e al limite
$offset = ($page - 1) * $limit;

// Calcola il numero totale di righe nel database per il tavolo specificato
$totalRowsQuery = "SELECT COUNT(*) AS totalRows FROM posts WHERE `table` = $tableId";
$totalRowsResult = mysqli_query($con, $totalRowsQuery);
$totalRows = mysqli_fetch_assoc($totalRowsResult)['totalRows'];

// Verifica se l'offset è superiore al numero totale di righe
if ($offset >= $totalRows) {
    // Restituisci un messaggio indicando che hai raggiunto la fine dei risultati
    echo json_encode(array('message' => 'Fine dei risultati.'));
    exit; // Termina lo script qui
}

// Costruzione della query
$query = "SELECT * FROM posts WHERE `table` = $tableId ORDER BY views DESC LIMIT $limit OFFSET $offset";

// Esegui la query
$result = mysqli_query($con, $query);

// Verifica se ci sono risultati
if (mysqli_num_rows($result) > 0) {
    // Array per immagazzinare i dati dei post
    $posts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    // Codifica l'array dei post in formato JSON e stampalo
    echo json_encode($posts);
} else {
    // Nessun post trovato
    echo json_encode(array('message' => 'Nessun post trovato.'));
}

// Chiudi la connessione
mysqli_close($con);
?>