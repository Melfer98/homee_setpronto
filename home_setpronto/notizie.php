<?php
include('db.php');

try {
    $query = "SELECT id, titolo, immagine_url FROM notizie";
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
    <title>SetPronto - Tutte le Notizie</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Agrega tus estilos personalizados aquí */
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

        #news-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
        }

        .news-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            transition: transform 0.2s;
        }

        .news-item:hover {
            transform: scale(1.05);
        }

        .news-item h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .news-item h2 a {
            text-decoration: none; 
            color: inherit; 
        }

        .news-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        p {
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <?php include 'header.html'; ?>

    <div id="news-section">
        <h1>Tutte le Notizie</h1>
    </div>

    <div id="news-list">
        <?php
        if (!empty($newsList)) {
            foreach ($newsList as $news) {
                echo "<div class='news-item'>";
                echo "<h2><a href='notizia.php?id={$news['id']}'>{$news['titolo']}</a></h2>";
                echo "<img src='{$news['immagine_url']}' alt='{$news['titolo']}'>";
                echo "</div>";
            }
        } else {
            echo "<p>Nessuna notizia disponibile.</p>";
        }
        ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
