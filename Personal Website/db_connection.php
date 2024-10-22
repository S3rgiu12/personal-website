<?php
// db_connection.php
$host = 'localhost';  // serverul de baze de date (de obicei, localhost)
$dbname = 'sitep';  // numele bazei de date
$username = 'root';  // utilizatorul bazei de date
$password = '';  // parola utilizatorului

try {
    // Creăm conexiunea la baza de date folosind PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Setăm modul de raportare a erorilor pe EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexiunea la baza de date a eșuat: " . $e->getMessage();
}
?>
