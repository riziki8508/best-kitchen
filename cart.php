<?php
session_start();
include 'include/db.php';

// Hakikisha mtumiaji ameingia (Login check kwa usalama)
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// 1. AUTO ADDING: Ongeza bidhaa kwenye katoro
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];
    
    // Angalia kama bidhaa tayari ipo kwenye cart
    $check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");
    
    if (mysqli_num_rows($check_cart) > 0) {
        // Kama ipo, ongeza idadi (Quantity)
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'");
    } else {
        // Kama haipo, iweke mpya
        mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)");
    }
    header('location:cart.php');
}

// 2. DELETE: Ondoa bidhaa moja moja
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id' AND user_id = '$user_id'");
    header('location:cart.php');
}

// 3. CLEAR ALL: Safisha katoro lote
if (isset($_GET['clear_all'])) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    header('location:cart.php');
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <title>Katoro la Vyombo | Vyombo Store</title>
    <link rel="stylesheet" href="style/index.css/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    
</head>
<body>
    

<header>
    <div class="top-nav">
        <div class="logo">VYOMBO<span>BORA</span></div>
        <nav class="navbar">
            <a href="index.php">Rudi Kwenye Bidhaa</a>
        </nav>
    </div>
</header>

<section class="products">
    <h2 class="heading">Kapu Lako la Ununuzi</h2>

    <table style="width:100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden;">
        <thead style="background: #2c3e50; color: white;">
            <tr>
                <th style="padding: 15px;">Picha</th>
                <th>Jina</th>
                <th>Bei</th>
                <th>Idadi</th>
                <th>Jumla Ndogo</th>
                <th>Kitendo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            $cart_query = mysqli_query($conn, "SELECT cart.id as cart_id, products.name, products.price, products.image, cart.quantity 
             FROM cart JOIN products ON cart.product_id = products.id 
            WHERE cart.user_id = '$user_id'");
            
            if (mysqli_num_rows($cart_query) > 0) {
                while ($item = mysqli_fetch_assoc($cart_query)) {
                    $sub_total = $item['price'] * $item['quantity'];
                    $grand_total += $sub_total;
            ?>
            <tr style="text-align: center; border-bottom: 1px solid #ddd;">
                <td><img src="assets/images/<?php echo $item['image']; ?>" width="80"></td>
                <td><?php echo $item['name']; ?></td>
                <td>Tsh <?php echo number_format($item['price']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>Tsh <?php echo number_format($sub_total); ?></td>
                <td>
                    <a href="cart.php?delete=<?php echo $item['cart_id']; ?>" style="color: red;" onclick="return confirm('Ondoa bidhaa hii?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' style='padding: 20px; text-align:center;'>Katoro lako lipo wazi!</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div style="margin-top: 20px; background: white; padding: 20px; border-radius: 8px; text-align: right;">
        <h3>Jumla Kuu: <span style="color: #e67e22;">Tsh <?php echo number_format($grand_total); ?>/-</span></h3>
        <hr style="margin: 15px 0;">
        <a href="cart.php?clear_all" class="btn" style="background: #c0392b; padding: 1rem 2.5rem;
    border-radius: .5rem;
    font-weight: 700;">Futa Vyote</a>
        <a href="checkout.php" class="btn" style="background: #27ae60; padding: 1rem 2.5rem;
    border-radius: .5rem;
    font-weight: 700;">Endelea na Malipo </a>
    </div>
</section>

</body>
</html>