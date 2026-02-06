<?php
// Anza session kama haijaanza bado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'include/db.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <div class="top-nav">
        <div class="logo">VYOMBO<span>BORA</span></div>
        
        <form action="products.php" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Tafuta chombo unachotaka...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <div class="icons">
            <a href="cart.php" title="Katoro">
                <i class="fa fa-shopping-cart"></i>
                <?php
                // Kuonyesha idadi ya vitu kwenye cart
                if($user_id){
                    $count_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
                    echo "<span style='background:var(--orange); border-radius:50%; padding:2px 6px; font-size:12px;'>".mysqli_num_rows($count_cart)."</span>";
                }
                ?>
            </a>
            <div id="menu-btn" class="fa fa-bars"></div>
        </div>
    </div>

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        
        <?php if($user_role == 'admin'): ?>
            <a href="admin/index.php" style="color: #e67e22; font-weight: bold;">ADMIN PANEL</a>
        <?php endif; ?>

        <?php if($user_id): ?>
            <a href="logout.php" class="logout-link">Logout</a>
        <?php else: ?>
            <a href="login.php">Login / Register</a>
        <?php endif; ?>
    </nav>
</header>