<?php
session_start(); // Sitzung starten

// Datenbankverbindung mit PDO
$host = 'localhost';
$dbname = 'powderpoints';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fehler: Verbindung fehlgeschlagen! " . $e->getMessage());
}

$error = ""; // Fehler-Variable initialisieren

// Prüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Benutzer aus der Datenbank abrufen
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: trainer.php");
            exit();
        } else {
            $error = "Falsches Passwort!";
        }
    } else {
        $error = "Benutzername existiert nicht!";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PowderPoints – Anmeldung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('../Bilder/bild für website.jpg'); /* Schneelandschaft als Hintergrund */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .snow-effect {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }
        .icon-btn img {
            border-radius: 50%;
            background: white;
            padding: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-900 text-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex-1 flex justify-center">
            <!--<img src="logo.png" alt="Logo" class="h-16">-->
        </div>
        <div class="flex space-x-6">
            <a href="hsmelden.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski symbol.jpg" alt="Highscore" class="h-8 w-8 mr-2"> Highscore
            </a>
            <a href="login.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login mänchen.jpg" alt="Anmelden" class="h-8 w-8 mr-2"> Anmelden
            </a>
            <a href="startseite.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski symbol.jpg" alt="startseite" class="h-8 w-8 mr-2" />Startseite
            </a>
        </div>
    </header>

    <!-- Login-Formular -->
    <main class="flex-grow flex items-center justify-center py-10">
        <div class="snow-effect w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-4">Anmeldung</h2>

            <?php if (!empty($error)) : ?>
                <p class="text-red-600 text-center mb-4"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-4">
                <input type="text" name="username" placeholder="Benutzername" required
                    class="w-full p-3 border border-gray-300 rounded" />
                <input type="password" name="password" placeholder="Passwort" required
                    class="w-full p-3 border border-gray-300 rounded" />
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">Login</button>
            </form>
        </div>
    </main>
</body>
</html>
