<?php
    $con = mysqli_connect("localhost", "Giuseppe", "Pass1234", "Biblioteca");
    if (mysqli_connect_errno()) {
        echo "impossibile connettersi al database:" . mysqli_connect_error();
        exit();
    }

    $POST_Libro = "INSERT INTO tabella (testo)
        VALUES ('$_POST[testo]')";
    if (mysqli_query($POST_Libro)) {
        echo "Query eseguita con successo";
    } else {
        echo "Errore:" . mysqli_error($con);
    }
    mysqli_close($con)
?>



<!-- INSERT INTO posts (id, title, views, `table`, category)
VALUES 
    (1, 'a title', 100, 2, 1), -->