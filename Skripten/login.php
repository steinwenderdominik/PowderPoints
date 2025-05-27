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

    // Benutzername prüfen
    if ($user) {
        // Passwort prüfen
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            // Weiterleitung zu trainer.php
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Anmeldung</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4">Anmelden</h2>
        <?php if (!empty($error)) : ?>
            <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Benutzername" required class="w-full p-2 border border-gray-300 rounded" />
            <input type="password" name="password" placeholder="Passwort" required class="w-full p-2 border border-gray-300 rounded" />
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
