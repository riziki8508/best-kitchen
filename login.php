<?php
session_start();
include 'include/db.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Tafuta mtumiaji kwenye database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Hakiki password (Inatakiwa iwe imefanyiwa hash wakati wa kuregister)
        if (password_verify($password, $row['password'])) {
            
            // Hifadhi taarifa kwenye SESSION
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['role'] = $row['role']; // Hapa ndipo tunatofautisha Admin na User

            // Elekeza mtumiaji kulingana na ROLE yake
            if ($row['role'] == 'admin') {
                header("Location: admin/index.php"); // Admin Dashboard
            } else {
                header("Location: index.php"); // Customer Home Page
            }
            exit();
        } else {
            $error = "Password siyo sahihi!";
        }
    } else {
        $error = "Email hii haijasajiliwa!";
    }
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <title>Login | Vyombo Store</title>
    <link rel="stylesheet" href="./style/index.css">
    <style>
        .login-form {
            max-width: 400px; margin: 50px auto; padding: 20px;
            background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-form input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; }
        .error { color: red; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="login-form">
    <h2>Ingia Kwenye Akaunti</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Barua Pepe (Email)" required>
        <input type="password" name="password" placeholder="Nenosiri (Password)" required>
        <button type="submit" name="login" class="btn" style="width: 100%;">Ingia</button>
    </form>
    <p>Huna akaunti? <a href="register.php">Jisajili hapa</a></p>
</div>

</body>
</html>