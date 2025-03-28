<?php
// Benutzername und Passwort für die HTTP-Authentifizierung
$benutzername = 'powder';
$passwort = 'points';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
    ($_SERVER['PHP_AUTH_USER'] != $benutzername) || ($_SERVER['PHP_AUTH_PW'] != $passwort)) {
        
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="PowderPoints"');

        exit('<h2>PowderPoints</h2><p>Tut uns leid, aber auf diese Seite können Sie nur mit den richtigen Zugangsdaten zugreifen.</p>');
}
?>
