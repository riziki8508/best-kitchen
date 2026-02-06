<?php 
session_start();
include 'include/db.php'; 

// Kupata role ya mtumiaji kwa ajili ya menu
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidhaa Zote | Vyombo Store</title>
    <link rel="stylesheet" href="style.css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<style>
    /* Google Fonts - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

:root {
    --orange: #e67e22;
    --dark: #2c3e50;
    --light-bg: #f4f4f4;
    --white: #fff;
    --border: .1rem solid rgba(0,0,0,.1);
}

* {
    font-family: 'Poppins', sans-serif;
    margin: 0; padding: 0;
    box-sizing: border-box;
    outline: none; border: none;
    text-decoration: none;
    transition: all .2s linear;
}

body { background: var(--light-bg); }

/* --- HEADER & NAVIGATION --- */
header {
    position: sticky; top: 0; left: 0; right: 0;
    z-index: 1000; background: var(--white);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
}

.top-nav {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.5rem 5%; background: var(--dark);
}

.logo { font-size: 1.8rem; color: var(--white); font-weight: 700; }
.logo span { color: var(--orange); }

.search-bar {
    display: flex; width: 40%;
    background: var(--white); border-radius: .5rem; overflow: hidden;
}

.search-bar input { padding: .8rem 1rem; width: 100%; font-size: 1rem; }
.search-bar button { padding: 0 1.5rem; background: var(--orange); color: var(--white); cursor: pointer; }

.icons a, .icons div { font-size: 1.5rem; color: var(--white); margin-left: 1.5rem; cursor: pointer; }

.navbar {
    display: flex; justify-content: center;
    background: var(--white); border-bottom: var(--border);
}

.navbar a { padding: 1rem 2rem; font-size: 1.1rem; color: var(--dark); font-weight: 500; }
.navbar a:hover { color: var(--orange); background: #eee; }

/* --- PRODUCT SECTION --- */
.products { padding: 3rem 5%; }
.heading { text-align: center; font-size: 2.5rem; color: var(--dark); margin-bottom: 2rem; text-transform: uppercase; }

.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.product-box {
    background: var(--white); padding: 1.5rem;
    text-align: center; border-radius: .8rem;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.05);
}

.product-box img { height: 200px; width: 100%; object-fit: contain; margin-bottom: 1rem; }
.product-box h3 { font-size: 1.3rem; color: var(--dark); margin: .5rem 0; }
.product-box .price { font-size: 1.4rem; color: var(--orange); font-weight: 700; margin-bottom: 1rem; }

.btn {
    display: inline-block; width: 100%; padding: .8rem;
    background: var(--dark); color: var(--white);
    border-radius: .5rem; font-size: 1rem; font-weight: 600;
}

.btn:hover { background: var(--orange); letter-spacing: 1px; }

/* --- FOOTER --- */
.footer { background: var(--dark); padding: 3rem 5%; color: var(--white); }
.footer .box-container {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;
}

.footer .box h3 { font-size: 1.5rem; margin-bottom: 1.5rem; color: var(--orange); }
.footer .box a, .footer .box p { display: block; font-size: 1rem; color: #ccc; margin-bottom: 1rem; }
.footer .box a i { color: var(--orange); margin-right: .5rem; }

.credit {
    text-align: center; margin-top: 3rem; padding-top: 2rem;
    border-top: .1rem solid rgba(255,255,255,.1); font-size: 1rem; color: #ccc;
}

/* --- RESPONSIVE DESIGN --- */
@media (max-width: 768px) {
    .search-bar { display: none; }
    .navbar { position: absolute; top: 100%; left: 0; right: 0; background: var(--white); flex-direction: column; display: none; }
    .navbar.active { display: flex; }
}
</style>
<header>
    <div class="top-nav">
        <div class="logo">VYOMBO<span>BORA</span></div>
        <form action="products.php" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Tafuta chombo unachotaka...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <div class="icons">
            <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
            <div id="menu-btn" class="fa fa-bars"></div>
        </div>
    </div>

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <?php if($user_role == 'admin'): ?>
            <a href="admin/index.php" style="color: yellow;">ADMIN PANEL</a>
        <?php endif; ?>
        <?php if($user_id): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<section class="products">
    <h1 class="heading">Katalogi ya Vyombo</h1>

    <div class="product-container">
        <?php
        // Logic ya Search Engine
        $search_query = "";
        if(isset($_GET['search'])){
            $filter = mysqli_real_escape_string($conn, $_GET['search']);
            $search_query = " WHERE name LIKE '%$filter%' OR description LIKE '%$filter%' ";
        }

        $select_products = mysqli_query($conn, "SELECT * FROM products $search_query");
        
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>
        <div class="product-box">
            <img src="assets/images/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <p style="font-size: 0.8rem; color: #666;"><?php echo substr($fetch_product['description'], 0, 50); ?>...</p>
            <div class="price">Tsh <?php echo number_format($fetch_product['price']); ?>/-</div>
            <a href="cart.php?add=<?php echo $fetch_product['id']; ?>" class="btn">Weka Kwenye Cart</a>
        </div>
        <?php 
            }
        } else {
            echo "<p style='text-align:center; width:100%;'>Samahani, hatujapata chombo unachotafuta.</p>";
        }
        ?>
    </div>
</section>

<footer class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="privacy_policy.php">Privacy Policy</a>
            <a href="terms.php">Terms & Conditions</a>
        </div>
        <div class="box">
            <h3>Tufuate</h3>
            <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
        <div class="box">
            <h3>Ofisi Zetu</h3>
            <p><i class="fa fa-map-marker-alt"></i> Kariakoo, Dar es Salaam</p>
            <p><i class="fa fa-phone"></i> +255 700 000 000</p>
        </div>
    </div>
    <div class="credit"> &copy; <?php echo date('Y'); ?> <span>Vyombo Bora Tanzania</span> </div>
</footer>

<script>
// Script ya Toggle Menu
let navbar = document.querySelector('.navbar');
document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
}
</script>

</body>
</html>