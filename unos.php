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

    
  
    <div class="container">
        <section class="news-section">
            <h2 class="section-title">DODAJ NOVU VIJEST</h2>
            
            <div class="news-grid">
                <div class="news-item form-container">
                    <div class="news-content">
                        <form action="skripta.php" method="POST" enctype="multipart/form-data">
                            <div class="form-item">
                                <label for="title">Naslov vijesti</label>
                                <div class="form-field">
                                    <input type="text" name="title" id="title" class="form-field-textual" required>
                                </div>
                            </div>
                     
                            <div class="form-item">
                                <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                                <div class="form-field">
                                    <textarea name="about" id="about" cols="30" rows="4" class="form-field-textual" maxlength="50" required></textarea>
                                </div>
                            </div>
                     
                            <div class="form-item">
                                <label for="content">Sadržaj vijesti</label>
                                <div class="form-field">
                                    <textarea name="content" id="content" rows="8" class="form-field-textual" required></textarea>
                                </div>
                            </div>
                     
                            <div class="form-item">
                                <label for="pphoto">Slika:</label>
                                <div class="form-field">
                                    <input type="file" name="pphoto" id="pphoto" accept="image/jpg,image/gif,image/jpeg,image/png" class="form-field-textual">
                                </div>
                            </div>
                     
                            <div class="form-item">
                                <label for="category">Kategorija vijesti</label>
                                <div class="form-field">
                                    <select name="category" id="category" class="form-field-textual" required>
                                        <option value="">-- Odaberite kategoriju --</option>
                                        <option value="sport">Sport</option>
                                        <option value="politika">Politika</option>
                                    </select>
                                </div>
                            </div>
                     
                            <div class="form-item checkbox-item">
                                <div class="form-field">
                                    <input type="checkbox" name="archive" id="archive">
                                    <label for="archive">Spremiti u arhivu</label>
                                </div>
                            </div>
                     
                            <div class="form-item form-buttons">
                                <button type="reset" class="nav-link btn-secondary">Poništi</button>
                                <button type="submit" class="nav-link btn-primary">Objavi vijest</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
  
    


    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Le Monde - Ivan Jurjević - ivanjurjevic03@gmail.com - Godina izrade: 2025</p>
        </div>
    </footer>

    <?php mysqli_close($dbc); ?>
</body>
</html>