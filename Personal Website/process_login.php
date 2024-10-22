<?php
// Importăm fișierul de conexiune la baza de date
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preluăm datele din formular
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validăm datele introduse (opțional)
    if (empty($email) || empty($password)) {
        echo "Te rugăm să completezi toate câmpurile.";
        exit;
    }

    // Pregătim o interogare SQL pentru a găsi utilizatorul după email
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Verificăm dacă utilizatorul există
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificăm parola (hash-uita)
        if (password_verify($password, $user['password'])) {
            // Parola este corectă, putem autentifica utilizatorul
            session_start();
            $_SESSION['user_id'] = $user['id'];  // salvăm ID-ul utilizatorului în sesiune
            $_SESSION['email'] = $user['email']; // salvăm email-ul utilizatorului în sesiune
            echo "Autentificare reușită!";
            header('Location: dashboard.php'); // redirecționare către pagina principală după autentificare
        } else {
            // Parola este incorectă
            echo "Parola introdusă este greșită.";
        }
    } else {
        // Utilizatorul nu există
        echo "Nu există niciun cont asociat cu acest email.";
    }
}
?>
