<?php
session_start();
include 'connection.php';

$message = '';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    $stmt = $dbc->prepare("SELECT id, username, password, admin FROM korisnik WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['admin'];
            
            if($user['admin'] == 1) {
                
                header("Location: administracija.php");
                exit();
            } else {
                
                $message = "Pozdrav " . $user['username'] . "! Nemate administratorska prava za pristup ovoj stranici.";
            }
        } else {
            $message = "Neispravno korisničko ime ili lozinka. Molimo <a href='registracija.php'>registrirajte se</a> ako nemate korisnički račun.";
        }
    } else {
        $message = "Neispravno korisničko ime ili lozinka. Molimo <a href='registracija.php'>registrirajte se</a> ako nemate korisnički račun.";
    }
    
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde - Prijava</title>
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
                <li><a href="login.php" class="nav-link active">ADMINISTRACIJA</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="news-section">
                <h2 class="section-title">Prijava u sustav</h2>
                
                <?php if(!empty($message)): ?>
                <div class="news-item" style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 20px; margin-bottom: 30px;">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>
                
                <div class="news-item" style="padding: 40px; max-width: 500px; margin: 0 auto;">
                    <form method="POST" action="">
                        <div style="margin-bottom: 25px;">
                            <label for="username" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Korisničko ime:</label>
                            <input type="text" name="username" id="username" required 
                                   style="width: 100%; padding: 15px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                        </div>
                        
                        <div style="margin-bottom: 30px;">
                            <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Lozinka:</label>
                            <input type="password" name="password" id="password" required 
                                   style="width: 100%; padding: 15px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                        </div>
                        
                        <div style="text-align: center; margin-bottom: 20px;">
                            <button type="submit" name="login" 
                                    style="padding: 15px 40px; background-color: #333; color: white; border: none; font-family: inherit; font-size: 16px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px;">
                                Prijavite se
                            </button>
                        </div>
                        
                        <div style="text-align: center; border-top: 1px solid #ddd; padding-top: 20px;">
                            <p style="color: #666; margin-bottom: 10px;">Nemate korisnički račun?</p>
                            <a href="registracija.php" style="color: #0066cc; text-decoration: none; font-weight: bold;">
                                Registrirajte se ovdje
                            </a>
                        </div>
                    </form>
                </div>
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