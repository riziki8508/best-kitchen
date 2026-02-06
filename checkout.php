<?php
session_start();
include 'include/db.php';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Kupata Jumla ya Malipo
$total_query = mysqli_query($conn, "SELECT SUM(products.price * cart.quantity) as total 
 FROM cart JOIN products ON cart.product_id = products.id 
 WHERE cart.user_id = '$user_id'");
$total_data = mysqli_fetch_assoc($total_query);
$grand_total = $total_data['total'];

// Ikiwa katoro kiko wazi, mrudishe index
if ($grand_total <= 0) {
    header('location:index.php');
    exit();
}

// Logic ya Kuchakata Malipo (Payment Processing)
if (isset($_POST['complete_payment'])) {
    $method = $_POST['payment_method'];
    
    // 1. Record Order kwenye database
    $insert_order = mysqli_query($conn, "INSERT INTO orders (user_id, total_amount, payment_status) 
    VALUES ('$user_id', '$grand_total', 'completed')");
    
    if ($insert_order) {
        // 2. Safisha katoro baada ya malipo kufanikiwa
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
        
        // 3. Onyesha ujumbe wa mafanikio (Transaction confirmation)
        echo "<script>
                alert('Malipo ya TSH " . number_format($grand_total) . " kwa njia ya $method yamepokelewa! Oda yako inashughulikiwa.');
                window.location.href='index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <title>Checkout | Vyombo Store</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

<div class="checkout-container" style="max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; color: #2c3e50;">Kamilisha Malipo</h2>
    <p style="text-align: center; font-size: 1.2rem; margin-bottom: 20px;">Jumla ya Kulipa: <strong>Tsh <?php echo number_format($grand_total); ?>/-</strong></p>

    <form action="" method="POST" id="payment-form">
        <label>Chagua Njia ya Malipo:</label>
        <select name="payment_method" id="pay_method" style="width: 100%; padding: 10px; margin: 10px 0;" onchange="toggleFields()">
            <option value="Mobile Money">Mobile Money (M-Pesa / Mixx By Yas / Airtel Money / Halopesa)</option>
            <option value="Credit Card">Credit/Debit Card</option>
        </select>

        <div id="mobile_fields">
            <input type="text" name="phone" placeholder="Ingiza namba ya simu (mf: 07xx...)" style="width: 100%; padding: 10px; margin: 10px 0;">
        </div>

        <div id="card_fields" style="display: none;">
            <input type="text" placeholder="Namba ya Kadi (16 digits)" style="width: 100%; padding: 10px; margin: 10px 0;">
            <div style="display: flex; gap: 10px;">
                <input type="text" placeholder="MM/YY" style="flex: 1; padding: 10px;">
                <input type="text" placeholder="CVV" style="flex: 1; padding: 10px;">
            </div>
        </div>

        <button type="submit" name="complete_payment" class="btn" style="width: 100%; background: #27ae60; margin-top: 20px; cursor: pointer;">Lipa Sasa</button>
    </form>
</div>

<script>
function toggleFields() {
    var method = document.getElementById('pay_method').value;
    var mobile = document.getElementById('mobile_fields');
    var card = document.getElementById('card_fields');

    if (method === 'Credit Card') {
        card.style.display = 'block';
        mobile.style.display = 'none';
    } else {
     card.style.display = 'none';
     mobile.style.display = 'block';
    }
}
</script>

</body>
</html>