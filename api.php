<?php
    // if (!isset($_COOKIE['email' && 'password'])) {
    //     header("Location: login.html");
    //     exit();
    // }

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } elseif (isset($_COOKIE['email'])) { // Controlla se è presente un cookie con l'email memorizzata
        $email = $_COOKIE['email'];
    } else { // Se l'utente non è autenticato ne tramite sessione ne tramite cookie, reindirizza alla pagina di login
        header("Location: login/index.php/");
        exit();
    }

    $host = "localhost"; // Modifica questo con l'host del tuo database
    $username = "root"; // Modifica questo con il tuo nome utente del database
    $password = ""; // Modifica questo con la tua password del database
    $dbname = "prova"; // Modifica questo con il nome del tuo database

    $con = mysqli_connect($host, $username, $password, $dbname);

    if (!$con) {
        die("Connessione al database fallita: " . mysqli_connect_error());
    }

    $query = "SELECT userdata.* FROM login, userdata WHERE email = '$email'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $posts = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }

        if ($posts[0]['banner']!=null) {
            $banner = $posts[0]['banner'];
            $userId = "<img style=\"height: 100px; width: 100px; border-radius: 50%;\" src=\"" . $banner . "\">";
        } else {
            // Se il campo 'banner' non è definito nel record, puoi assegnare un'immagine predefinita o fare altre azioni di gestione
            $userId = "<img style=\"height: 100px; border-radius: 50%;\" src=\"https://thestatestimes.com/storage/post_display/20201213175850n562a.jpg\">";
        }

    } else {

        echo json_encode(array('message' => 'Nessun post trovato.'));
        header("Location: login/index.php/");
        exit();
    }

    // Chiudi la connessione
    mysqli_close($con);  

?>
<html>
    <head>
        <link rel="stylesheet" href="api.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="banner"  style="text-align: right; margin-right: 100px;"><?php echo $userId ?></div>
        <form method="post" id="table-cration-form">
            <input type="text" id="table-cration" translate="no" placeholder="tableName">
            <br>
            <button type="submit" id="buttoner" onclick="post_newTable()">crea</button>
        </form>
        ciao <div id="ciao"></div><br>

        <form method="post" id="data-table-form">
            <input type="text" id="title" translate="no" placeholder="title">
            <input type="text" id="views" translate="no" placeholder="views">
            <input type="text" id="table" translate="no" placeholder="table">
            <br>
            <button type="button" id="buttoner" onclick="post()">crea</button>
        </form>

        <div id="tableSpace">

        </div>
        
    </body>
    <script src="api.js"></script>
</html>