<?php
session_start();

$error = "";

// --- Lokale Benutzeranmeldung ---
$testUser = 'dominik';
// Neuer gültiger Passwort-Hash für 'powderpoints'
$testHash = '$2y$10$5CNozFJZ.5CDbYz0z/U9IuDfdgFkkCCZt3k6WGFsoZ7KGiDTS5QbC';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars($_POST['password']);

        if ($username === $testUser) {
            if (password_verify($password, $testHash)) {
                $_SESSION['user_id'] = 1;
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Falsches Passwort!";
            }
        } else {
            $error = "Benutzername existiert nicht!";
        }
    } else {
        $error = "Bitte alle Felder ausfüllen!";
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

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Benutzername" required class="w-full p-2 border border-gray-300 rounded" />
            <input type="password" name="password" placeholder="Passwort" required class="w-full p-2 border border-gray-300 rounded" />
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
