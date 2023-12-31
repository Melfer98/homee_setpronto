<?php
include('db.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $newsId = $_GET['id'];

    try {
        $query = "SELECT * FROM notizie WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id', $newsId);
        $statement->execute();

        $news = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$news) {
            echo "Notizia non trovata.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Errore: " . $e->getMessage();
        exit();
    }
} else {
    echo "ID della notizia non fornito o non valido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SetPronto - Notizia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--colore-principale);
            color: #333;
        }

        #news-section {
            background-color: var(--colore-nero);
            color: #fff;
            text-align: center;
            padding: 0.5em;
            margin-bottom: 10px;
        }

        .news-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-content h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .news-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .news-content p {
            font-size: 1.2em;
            text-align: justify;
        }

        .news-content p.author-date {
            font-size: 1em;
            font-weight: bold;
        }

        @media screen and (max-width: 600px) {
            .news-content {
                padding: 10px;
            }

            .news-content h1 {
                font-size: 1.5em;
            }

            .news-content img {
                margin-bottom: 10px;
            }

            .news-content p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.html'; ?>

    <div id="news-section">
        <h1>Notizia</h1>
    </div>
        <br><br>
    <div class="news-content">
        <h1><?php echo $news['titolo']; ?></h1>

        <?php
            if (!empty($news['immagine_url'])) {
                echo "<img src='{$news['immagine_url']}' alt='{$news['titolo']}'>";
            }
        ?>

        <p><?php echo $news['contenuto']; ?></p>

        <p class="author-date">Autore: <?php echo $news['autore']; ?></p>

        <p class="author-date">
            Data di Pubblicazione: <?php echo strftime('%e %B %Y', strtotime($news['data_pubblicazione'])); ?>
        </p>

        <?php
            if (!empty($news['link_video'])) {
                echo "<iframe width='100%' height='315' src='{$news['link_video']}' frameborder='0' allowfullscreen></iframe>";
            }
        ?>
    </div>
            <br><br>
    <script src="script.js"></script>
</body>
</html>

