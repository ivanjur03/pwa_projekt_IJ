<?php
session_start();
include 'connection.php';
define('UPLPATH', 'img/');

// Provjera je li korisnik prijavljen i ima admin prava
if(!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Brisanje zapisa
if(isset($_POST['delete'])){
    $id=$_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
}

// Update zapisa
if(isset($_POST['update'])){
    $picture = $_FILES['pphoto']['name'];
    $title=$_POST['title'];
    $about=$_POST['about'];
    $content=$_POST['content'];
    $category=$_POST['category'];
    if(isset($_POST['archive'])){
        $archive=1;
    }else{
        $archive=0;
    }
    
    if(!empty($picture)) {
        $target_dir = 'img/'.$picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    } else {
        $picture = $_POST['existing_image'];
    }
    
    $id=$_POST['id'];
    $query = "UPDATE vijesti SET naslov='$title', sadrzaj='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde - Administracija</title>
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
                <li><a href="administracija.php" class="nav-link active">ADMINISTRACIJA</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="news-section">
                <h2 class="section-title">Administracija vijesti</h2>
                
                <?php
                $query = "SELECT * FROM vijesti";
                $result = mysqli_query($dbc, $query);
                
                while($row = mysqli_fetch_array($result)) {
                    echo '<div class="news-item" style="margin-bottom: 40px; padding: 30px;">
                        <form enctype="multipart/form-data" action="" method="POST">
                            <div style="margin-bottom: 20px;">
                                <label for="title" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Naslov vijesti:</label>
                                <div>
                                    <input type="text" name="title" style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;" value="'.$row['naslov'].'">
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label for="about" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Kratki sadržaj vijesti (do 50 znakova):</label>
                                <div>
                                    <textarea name="about" cols="30" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px; resize: vertical;">'.$row['sadrzaj'].'</textarea>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label for="content" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Sadržaj vijesti:</label>
                                <div>
                                    <textarea name="content" cols="30" rows="8" style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px; resize: vertical;">'.$row['tekst'].'</textarea>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label for="pphoto" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Slika:</label>
                                <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                                    <input type="file" id="pphoto" name="pphoto" style="padding: 8px; border: 1px solid #ddd;"/>
                                    <img src="' . UPLPATH . $row['slika'] . '" width="100px" style="border: 1px solid #ddd;">
                                    <input type="hidden" name="existing_image" value="'.$row['slika'].'">
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label for="category" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Kategorija vijesti:</label>
                                <div>
                                    <select name="category" style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                                        <option value="sport"'.($row['kategorija'] == 'sport' ? ' selected' : '').'>Sport</option>
                                        <option value="kultura"'.($row['kategorija'] == 'kultura' ? ' selected' : '').'>Kultura</option>
                                        <option value="politika"'.($row['kategorija'] == 'politika' ? ' selected' : '').'>Politika</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">
                                    <div style="display: flex; align-items: center; gap: 8px;">';
                                        if($row['arhiva'] == 0) {
                                            echo '<input type="checkbox" name="archive" id="archive" style="width: 18px; height: 18px;"/>';
                                        } else {
                                            echo '<input type="checkbox" name="archive" id="archive" checked style="width: 18px; height: 18px;"/>';
                                        }
                                        echo 'Arhiviraj?
                                    </div>
                                </label>
                            </div>
                            
                            <div style="border-top: 1px solid #ddd; padding-top: 20px; margin-top: 30px;">
                                <input type="hidden" name="id" value="'.$row['id'].'">
                                <button type="reset" style="padding: 12px 24px; margin-right: 10px; background-color: #6c757d; color: white; border: none; font-family: inherit; cursor: pointer;">Poništi</button>
                                <button type="submit" name="update" style="padding: 12px 24px; margin-right: 10px; background-color: #28a745; color: white; border: none; font-family: inherit; cursor: pointer;">Izmjeni</button>
                                <button type="submit" name="delete" style="padding: 12px 24px; background-color: #dc3545; color: white; border: none; font-family: inherit; cursor: pointer;" onclick="return confirm(\'Jeste li sigurni da želite izbrisati ovu vijest?\')">Izbriši</button>
                            </div>
                        </form>
                    </div>';
                }
                ?>
            </div>
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