<?php
include('db.php');

try {
    $query = "SELECT id, titolo FROM notizie ORDER BY data_pubblicazione DESC";
    $result = $conn->query($query);

    if ($result) {
        $newsList = $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Errore nella query";
        exit();
    }
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SetPronto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'header_notizie.php';
    ?>
    <?php
    include 'header.html';
    ?>
    <div id="modal-container">
        <div id="modal-content">
            <button id="close-btn" onclick="closeModal()">X</button>
            <h2 style='text-align:center'>Chi Siamo</h2><br>
            <img src="img/btn-chisiamo.png" alt="Chi siamo" style="display: block; margin: 0 auto;"><br>
            <p>Setpronto nasce con l'obiettivo di fornire una gamma di servizi alle produzioni cinematografiche e televisive, offrendo un valido supporto durante le fasi di organizzazione e realizzazione del prodotto cinematografico e della piccola impresa.<br><br>

                Il modello organizzativo di Set Pronto rappresenta una novità assoluta, estremamente flessibile consentendo di orientare le sue attività secondo le esigenze dei propri clienti, garantendo la massima efficacia ed economicità dei servizi proposti. <br><br>

                Il nuovo programma per realizzare un perfetto spoglio cinematografico è quanto di più utile ed efficace ci sia in commercio. Non esiste un programma in grado di inserire tutti i dettagli e in automatico di fare quattro tipologie di stampe diverse per le esigenze dei vari reparti cinematografici e televisivi come quello ideato da "setpronto".</p><br><br>
        </div>
    </div>

    <div id="video-container">
        <a href="https://www.setpronto.it/accedi/formLogin.php">
            <video autoplay loop width="100%">
                <source src="img/menu.mp4" type="video/mp4">
                Il tuo browser non supporta l'elemento video.
            </video>
            <span id="overlay-btn">Servizi <br>cinematografici e televisivi per operatori del settore</span></a>
    </div>
    <br><br><br>
    <div id="image-info">
        <div class="info">
            <img src="img/3.png" alt="Location">
            <p>Indirizzo: <br> Piazza Alberto Alessio,900122,<br> Roma, Italy</p>
        </div>

        <div class="info">
            <img src="img/2.png" alt="Phone">
            <p>Telefono:<br> +39 338 949 0652 (Alessia)<br> +39 347 192 7737 (Pietro)</p>
        </div>

        <div class="info">
            <img src="img/1.png" alt="Email">
            <p>Email: info@setpronto.it<br>Partita IVA:<br> 14196151006</p>
        </div>
    </div>
    <br><br><br>


    <script src="script.js"></script>
</body>

</html>