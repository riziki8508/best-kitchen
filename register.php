<?php
include 'include/db.php';

$message = "";

if (isset($_POST['register'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Angalia kama email tayari ipo
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($check_email) > 0) {
        $message = "Email hii tayari imeshasajiliwa!";
    } elseif ($password != $confirm_password) {
        $message = "Nenosiri hazilingani!";
    } else {
        // 2. Fanya nenosiri kuwa siri (Security Hash)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // 3. Hifadhi kwenye database (Role ya kawaida ni 'user')
        $insert = "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$hashed_password', 'user')";
        
        if (mysqli_query($conn, $insert)) {
            header("Location: login.php?success=Akaunti imetengenezwa, tafadhali ingia.");
            exit();
        } else {
            $message = "Hitilafu imetokea, jaribu tena.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <title>Jisajili | Vyombo Store</title>
    <link rel="stylesheet" href="style/index.css">
    <style>
        .register-form {
            max-width: 450px; margin: 40px auto; padding: 25px;
            background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .register-form h2 { text-align: center; color: #2c3e50; margin-bottom: 20px; }
        .register-form input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; }
        .msg { color: #e74c3c; text-align: center; margin-bottom: 10px; font-weight: bold; }
        .btn-reg { width: 100%; background: #e67e22; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 5px; font-size: 1rem; }
        .btn-reg:hover { background: #d35400; }
    </style>
</head>
<body>

<div class="register-form">
    <h2>Tengeneza Akaunti</h2>
    <?php if($message != "") echo "<p class='msg'>$message</p>"; ?>
    
    <form action="" method="POST">
        <input type="text" name="fullname" placeholder="Jina Kamili" required>
        <input type="email" name="email" placeholder="Barua Pepe (Email)" required>
        <input type="password" name="password" placeholder="Nenosiri (Password)" required>
        <input type="password" name="confirm_password" placeholder="Rudia Nenosiri" required>
        <button type="submit" name="register" class="btn-reg">Jisajili Sasa</button>
    </form>
    <p style="text-align: center; margin-top: 15px;">Tayari una akaunti? <a href="login.php">Ingia hapa</a></p>
</div>

</body>
</html>