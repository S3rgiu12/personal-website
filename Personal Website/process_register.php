<?php
// Conectare la baza de date
$conn = new mysqli('localhost', 'root', '', 'sitep');

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

// Preluăm datele din formular
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$confirm_email = $_POST['confirm_email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Verificăm dacă emailurile și parolele coincid
if ($email !== $confirm_email || $password !== $confirm_password) {
    die("Emailurile sau parolele nu coincid.");
}

// Încărcăm poza de profil
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);

// Hashăm parola pentru siguranță
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserăm datele în baza de date
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, profile_pic) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $target_file);

if ($stmt->execute()) {
    header("Location: login.html");
} else {
    echo "A apărut o eroare: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
