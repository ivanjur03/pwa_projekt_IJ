<?php
include 'connection.php';
define('UPLPATH', 'img/');
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde - Početna</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Le Monde</h1>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="index.php" class="nav-link active">HOME</a></li>
                <li><a href="kategorija.php?kategorija=politika" class="nav-link">POLITIKA</a></li>
                <li><a href="kategorija.php?kategorija=sport" class="nav-link">SPORT</a></li>
                <li><a href="administracija.php" class="nav-link">ADMINISTRACIJA</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <!-- Politika sekcija -->
            <section class="news-section">
                <h2 class="section-title">
                    <?php
                    echo $_GET['kategorija'];
                    ?>
                </h2>
                <div class="news-grid">
                    <?php
                    $kategorija=$_GET['kategorija'];
                    $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija' ORDER BY datum DESC";
                    $result = mysqli_query($dbc, $query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result)) {
                            echo '<article class="news-item">';
                            echo '<div class="news-image">';
                            echo '<img src="' . UPLPATH . $row['slika'] . '" alt="' . htmlspecialchars($row['naslov']) . '">';
                            echo '</div>';
                            echo '<div class="news-content">';
                            echo '<h3 class="news-title">';
                            echo '<a href="clanak.php?id='.$row['id'].'">' . htmlspecialchars($row['naslov']) . '</a>';
                            echo '</h3>';
                            echo '</div>';
                            echo '</article>';
                        }
                    }
                    ?>
                </div>
            </section>

        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Le Monde - Ivan Jurjević - ivanjurjevic03@gmail.com - Godina izrade: 2025</p>
        </div>
    </footer>

    <?php mysqli_close($dbc); ?>
</body>
</html>