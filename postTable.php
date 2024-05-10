<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost"; // Modifica questo con l'host del tuo database
$username = "root"; // Modifica questo con il tuo nome utente del database
$password = ""; // Modifica questo con la tua password del database
$dbname = "prova"; // Modifica questo con il nome del tuo database

// Effettua la connessione
$con = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Impossibile connettersi al database: " . mysqli_connect_error();
    exit();
}

// Verifica se sono stati inviati dati tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leggi i dati inviati tramite il corpo della richiesta
    $data = json_decode(file_get_contents("php://input"), true);

    // Estrai i dati
    $tableValue = $data['table'];

    // Prepara la query di inserimento
    $query = "INSERT INTO comments (`table`) VALUES ($tableValue)";
    
    // Esegui la query
    if (mysqli_query($con, $query)) {
        echo json_encode(array("message" => "Inserimento avvenuto con successo."));
    } else {
        echo json_encode(array("message" => "Errore durante l'inserimento: " . mysqli_error($con)));
    }
} else {
    // Se la richiesta non è stata fatta tramite il metodo POST
    echo json_encode(array("message" => "Metodo non consentito."));
}

mysqli_close($con);
?>
