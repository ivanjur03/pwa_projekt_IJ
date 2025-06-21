<?php 
include 'connection.php'; 
define('UPLPATH', 'img/'); 

// Provjeri je li poslan ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];

// Dohvati članak iz baze
$query = "SELECT * FROM vijesti WHERE id = ? AND arhiva = 0";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['naslov']); ?> - Le Monde</title>
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
                <li><a href="index.php" class="nav-link">HOME</a></li>
                <li><a href="kategorija.php?kategorija=politika" class="nav-link">POLITIKA</a></li>
                <li><a href="kategorija.php?kategorija=sport" class="nav-link">SPORT</a></li>
                <li><a href="administracija.php" class="nav-link">ADMINISTRACIJA</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <section class="news-section">
                <div class="news-grid single-article">
                    <article class="news-item full-article">
                        <div class="news-content">
                            <div class="category-tag">
                                <?php echo strtoupper($row['kategorija']); ?>
                            </div>
                            
                            <h1 class="news-title">
                                <?php echo htmlspecialchars($row['naslov']); ?>
                            </h1>
                            <div class="article-summary">
                                <p><strong><?php echo htmlspecialchars($row['sadrzaj']); ?></strong></p>
                            </div>
                            
                        </div>
                        
                        <?php if (!empty($row['slika'])): ?>
                        <div class="news-image">
                            <img src="<?php echo UPLPATH . htmlspecialchars($row['slika']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['naslov']); ?>">
                        </div>
                        <?php endif; ?>
                        
                        <div class="news-content article-body">
                            
                            
                            <div class="article-text">
                                <?php echo nl2br(htmlspecialchars($row['tekst'])); ?>
                            </div>
                            
                        
                        </div>
                    </article>
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