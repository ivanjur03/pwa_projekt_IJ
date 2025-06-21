<?php
session_start();
include 'connection.php';

$message = '';
$success = false;

if(isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    
    // Validacija
    if(empty($username) || empty($email) || empty($password) || empty($ime) || empty($prezime)) {
        $message = "Sva polja su obavezna!";
    } elseif($password !== $confirm_password) {
        $message = "Lozinke se ne podudaraju!";
    } elseif(strlen($password) < 6) {
        $message = "Lozinka mora imati najmanje 6 znakova!";
    } else {
        // Provjera postoji li već korisničko ime
        $stmt = $dbc->prepare("SELECT id FROM korisnik WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $message = "Korisničko ime već postoji! Molimo odaberite drugo.";
        } else {
            // Provjera postoji li već email
            $stmt = $dbc->prepare("SELECT id FROM korisnik WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows > 0) {
                $message = "Email adresa je već registrirana!";
            } else {
                // Hashiranje lozinke
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Unos novog korisnika (admin = 0 po defaultu)
                $stmt = $dbc->prepare("INSERT INTO korisnik (username, email, password, ime, prezime, admin) VALUES (?, ?, ?, ?, ?, 0)");
                $stmt->bind_param("sssss", $username, $email, $hashed_password, $ime, $prezime);
                
                if($stmt->execute()) {
                    $success = true;
                    $message = "Uspješno ste se registrirali! Možete se sada prijaviti.";
                } else {
                    $message = "Greška pri registraciji. Molimo pokušajte ponovno.";
                }
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde - Registracija</title>
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
                <li><a href="login.php" class="nav-link">ADMINISTRACIJA</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="news-section">
                <h2 class="section-title">Registracija novog korisnika</h2>
                
                <?php if(!empty($message)): ?>
                <div class="news-item" style="background-color: <?php echo $success ? '#d4edda' : '#f8d7da'; ?>; border: 1px solid <?php echo $success ? '#c3e6cb' : '#f5c6cb'; ?>; color: <?php echo $success ? '#155724' : '#721c24'; ?>; padding: 20px; margin-bottom: 30px;">
                    <?php echo $message; ?>
                    <?php if($success): ?>
                        <br><br>
                        <a href="login.php" style="color: #155724; font-weight: bold;">Idite na stranicu za prijavu</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <div class="news-item" style="padding: 40px; max-width: 600px; margin: 0 auto;">
                    <form method="POST" action="">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                            <div>
                                <label for="ime" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Ime:</label>
                                <input type="text" name="ime" id="ime" required 
                                       value="<?php echo isset($_POST['ime']) ? htmlspecialchars($_POST['ime']) : ''; ?>"
                                       style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                            </div>
                            <div>
                                <label for="prezime" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Prezime:</label>
                                <input type="text" name="prezime" id="prezime" required 
                                       value="<?php echo isset($_POST['prezime']) ? htmlspecialchars($_POST['prezime']) : ''; ?>"
                                       style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 25px;">
                            <label for="username" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Korisničko ime:</label>
                            <input type="text" name="username" id="username" required 
                                   value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                                   style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                        </div>
                        
                        <div style="margin-bottom: 25px;">
                            <label for="email" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Email adresa:</label>
                            <input type="email" name="email" id="email" required 
                                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                   style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                            <div>
                                <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Lozinka:</label>
                                <input type="password" name="password" id="password" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                                <small style="color: #666;">Najmanje 6 znakova</small>
                            </div>
                            <div>
                                <label for="confirm_password" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Potvrdite lozinku:</label>
                                <input type="password" name="confirm_password" id="confirm_password" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ddd; font-family: inherit; font-size: 16px;">
                            </div>
                        </div>
                        
                        <div style="text-align: center; margin-bottom: 20px;">
                            <button type="submit" name="register" 
                                    style="padding: 15px 40px; background-color: #28a745; color: white; border: none; font-family: inherit; font-size: 16px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px;">
                                Registriraj se
                            </button>
                        </div>
                        
                        <div style="text-align: center; border-top: 1px solid #ddd; padding-top: 20px;">
                            <p style="color: #666; margin-bottom: 10px;">Već imate korisnički račun?</p>
                            <a href="login.php" style="color: #0066cc; text-decoration: none; font-weight: bold;">
                                Prijavite se ovdje
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