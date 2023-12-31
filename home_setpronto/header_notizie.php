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
    <title>SetPronto - Notizie</title>
    <style>
        #news-section {
            width: 100%;
            text-align: center;
        }

        #news-slider {
            overflow: hidden;
        }

        .news-container {
            display: flex;
            transition: transform 0.3s ease;
        }

        .news-item {
            flex: 0 0 100%;
            box-sizing: border-box;
            white-space: nowrap;
        }

        .news-item a {
            text-decoration: none;
            color: #0B4D97;
            font-weight: bold;
            display: inline-block;
            padding: 10px;
        }

        @media screen and (max-width: 600px) {
            .news-item {
                flex: 0 0 100%;
                box-sizing: border-box;
                white-space: normal;
            }
        }
    </style>
</head>

<body>
    <div id="news-section">
        <h2 style='margin-bottom:0px'>Ultime Notizie</h2>
        <?php if (!empty($newsList)) : ?>
            <div id="news-slider">
                <div class="news-container">
                    <?php foreach ($newsList as $news) : ?>
                        <div class='news-item'><a href='notizia.php?id=<?php echo $news['id']; ?>'><?php echo $news['titolo']; ?></a></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else : ?>
            <p>Nessuna notizia disponibile.</p>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const newsSlider = document.getElementById('news-slider');
            const newsContainer = document.querySelector('.news-container');
            const newsItems = document.querySelectorAll('.news-item');
            const newsItemCount = <?php echo count($newsList); ?>;
            let currentIndex = 0;

            function showNews(index) {
                const translateValue = -index * 100 + '%';
                newsContainer.style.transform = 'translateX(' + translateValue + ')';
            }

            function showNextNews() {
                currentIndex = (currentIndex + 1) % newsItemCount;
                showNews(currentIndex);
            }

            setInterval(showNextNews, 6500);
        });
    </script>
</body>

</html>