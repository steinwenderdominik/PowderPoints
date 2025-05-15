<?php
session_start(); // Sitzung starten

// 1. **Datenbankverbindung mit PDO**
$host = 'localhost';
$dbname = 'powderpoints';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // Fehler im Exception-Modus behandeln
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fehler: Verbindung fehlgeschlagen! " . $e->getMessage());
}

$error = ""; // Fehler-Variable initialisieren

// 2. **Prüfen, ob das Formular abgeschickt wurde**
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 3. **Benutzer aus der Datenbank abrufen**
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // 4. **Benutzername prüfen**
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 5. **Passwort prüfen**
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldung</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4">Anmelden</h2>
        <?php if (!empty($error)) echo "<p class='text-red-500'>" . htmlspecialchars($error) . "</p>"; ?>
        
        <!-- 6. **Anmeldeformular** -->
        <form action="" method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Benutzername" required class="w-full p-2 border border-gray-300 rounded" />
            <input type="password" name="password" placeholder="Passwort" required class="w-full p-2 border border-gray-300 rounded" />
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
