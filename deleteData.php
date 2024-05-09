<?php

    $host = "localhost"; // Modifica questo con l'host del tuo database
    $username = "root"; // Modifica questo con il tuo nome utente del database
    $password = ""; // Modifica questo con la tua password del database
    $dbname = "prova"; // Modifica questo con il nome del tuo database

    // Effettua la connessione al database
    $con = mysqli_connect($host, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo "Impossibile connettersi al database: " . mysqli_connect_error();
        exit();
    }

    // Verifica se è stato fornito un ID valido
    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $id = intval($_GET['id']); // Ottieni l'ID dall'URL e convertilo in un intero

        // Prepara la query per eliminare il record
        $query = "DELETE FROM posts WHERE id = $id";

        // Esegui la query
        if (mysqli_query($con, $query)) {
            echo json_encode(array("message" => "Record eliminato con successo."));
        } else {
            echo json_encode(array("message" => "Errore durante l'eliminazione del record: " . mysqli_error($con)));
        }
    } else {
        // Se la richiesta non è stata fatta tramite il metodo DELETE
        echo json_encode(array("message" => "Metodo non consentito."));
    }

    // Chiudi la connessione al database
    mysqli_close($con);

?>
