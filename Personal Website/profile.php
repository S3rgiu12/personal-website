<?php
session_start();

// Verificăm dacă utilizatorul este logat
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profile page for logged in users.">
    <meta name="author" content="Dumitrasc Sergiu-Emilian">
    <title>Profile - <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .profile-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-container img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        .profile-container h2 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #333;
        }
        .profile-container p {
            font-size: 16px;
            color: #555;
        }
        .profile-container a {
            text-decoration: none;
            color: #333;
            margin-top: 20px;
        }
        .profile-container a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- Afișăm poza de profil -->
        <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="Profile Picture">
        
        <!-- Afișăm numele utilizatorului -->
        <h2><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></h2>
        
        <!-- Afișăm email-ul utilizatorului -->
        <p>Email: <?php echo $_SESSION['email']; ?></p>
        
        <!-- Link către o pagină de setări sau deconectare -->
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
