<?php
include('db.php');

$message = ''; // Variable para almacenar el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $titolo = $_POST['titolo'];
        $contenuto = $_POST['contenuto'];
        $immagine_url = $_POST['immagine_url'];
        $link_video = $_POST['link_video'];
        $autore = $_POST['autore'];
        $data_pubblicazione = $_POST['data_pubblicazione'];

        $query = "INSERT INTO notizie (titolo, contenuto, immagine_url, link_video, autore, data_pubblicazione) 
                  VALUES (:titolo, :contenuto, :immagine_url, :link_video, :autore, :data_pubblicazione)";

        $statement = $conn->prepare($query);
        $statement->bindParam(':titolo', $titolo);
        $statement->bindParam(':contenuto', $contenuto);
        $statement->bindParam(':immagine_url', $immagine_url);
        $statement->bindParam(':link_video', $link_video);
        $statement->bindParam(':autore', $autore);
        $statement->bindParam(':data_pubblicazione', $data_pubblicazione);

        if ($statement->execute()) {
            $message = "Notizia aggiunta con successo.";
        } else {
            $message = "Errore nell'aggiunta della notizia.";
        }
    } catch (PDOException $e) {
        $message = "Errore: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SetPronto - Aggiungi Notizia</title>
    <style>
       
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include 'header.html';
    ?>
    <div id="news-section">
        <h1 style="text-align:center">Aggiungi una Notizia</h1>
    </div>
    
    <div id="form-notizia">
        <form action="nuova_notizia.php" method="post">
            <label for="titolo">Titolo:</label>
            <textarea name="titolo" id="titoloInput" placeholder="Titolo" oninput="autoSize(this)" required></textarea><br>

            <label for="contenuto">Contenuto:</label>
            <textarea name="contenuto" id="contenutoTextarea" placeholder="Contenuto" oninput="autoSize(this)" required></textarea><br>

            <label for="autore">Autore:</label>
            <input type="text" name="autore" placeholder="Autore" required><br>

            <label for="immagine_url">URL dell'Immagine:</label>
            <input type="text" name="immagine_url" placeholder="URL dell'Immagine"><br>

            <label for="link_video">URL del Video:</label>
            <input type="text" name="link_video" placeholder="URL del Video"><br>

            <label for="data_pubblicazione">Data di Pubblicazione:</label>
            <input type="date" name="data_pubblicazione" required><br>

            <input type="submit" value="Aggiungi Notizia">
        </form>
    </div>

    <div id="popoverlay"></div>
    <div id="popup">
        <h2>Conferma</h2>
        <p id="popup-message"><?php echo $message; ?></p>
        <button onclick="closePopup()">Chiudi</button>
    </div>

    <div id="confirmation-section">
        <?php
            if (!empty($message)) {
                echo "<h2>$message</h2>";
            }
        ?>
    </div>

    <script>
        function openPopup() {
            document.getElementById('popoverlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popoverlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }

        <?php echo !empty($message) ? 'openPopup();' : ''; ?>
    </script>

    <script>
        function autoSize(element) {
            element.style.height = "1px";
            element.style.height = (element.scrollHeight) + "px";
        }
    </script>

    <script src="script.js"></script>
</body>
</html>
