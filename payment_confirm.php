<?php
include '../include/db.php';
include '../include/auth.php';
checkAdmin(); // Inahakikisha ni Admin tu anayeweza kuona ukurasa huu

// 1. Logic ya kubadilisha hali ya malipo (Update Status)
if(isset($_GET['update_payment'])){
    $order_id = $_GET['update_payment'];
    $new_status = 'completed';
    
    $update_query = mysqli_query($conn, "UPDATE `orders` SET payment_status = '$new_status' WHERE id = '$order_id'") or die('Query imefeli');
    header('location:payment_confirm.php');
}

// 2. Logic ya kufuta oda (Delete Order)
if(isset($_GET['delete_order'])){
    $delete_id = $_GET['delete_order'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Query imefeli');
    header('location:payment_confirm.php');
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Thibitisha Malipo | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --orange: #e67e22; --dark: #2c3e50; --white: #fff; --light: #f4f4f4; }
        body { font-family: 'Poppins', sans-serif; background: var(--light); margin: 0; padding: 20px; }
        
        .admin-nav { background: var(--dark); padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .admin-nav a { color: white; text-decoration: none; margin-right: 20px; font-weight: bold; }
        
        .order-table { width: 100%; border-collapse: collapse; background: var(--white); box-shadow: 0 5px 10px rgba(0,0,0,0.1); }
        .order-table th, .order-table td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .order-table th { background: var(--dark); color: white; }
        
        .status-pending { color: #e74c3c; font-weight: bold; background: #ffd7d7; padding: 5px; border-radius: 4px; }
        .status-completed { color: #27ae60; font-weight: bold; background: #d4f8e2; padding: 5px; border-radius: 4px; }
        
        .btn-confirm { background: #27ae60; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn-delete { background: #e74c3c; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn-confirm:hover, .btn-delete:hover { opacity: 0.8; }
    </style>
</head>
<body>

<div class="admin-nav">
    <a href="index.php">Dashboard</a>
    <a href="manage_products.php">Bidhaa</a>
    <a href="payment_confirm.php" style="color: var(--orange);">Malipo/Oda</a>
    <a href="view_messages.php">Ujumbe</a>
    <a href="../logout.php"></Object>ndoka</a>
</div>

<h2 style="color: var(--dark);">Usimamizi wa Oda na Malipo</h2>

<table class="order-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mteja</th>
            <th>Simu</th>
            <th>Jumla (Tsh)</th>
            <th>Njia ya Malipo</th>
            <th>Hali ya Malipo</th>
            <th>Kitendo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY id DESC") or die('Query imefeli');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        ?>
        <tr>
            <td><?php echo $fetch_orders['id']; ?></td>
            <td><?php echo $fetch_orders['mteja']; ?></td>
            <td><?php echo $fetch_orders['number']; ?></td>
            <td><?php echo number_format($fetch_orders['total_price']); ?>/-</td>
            <td><?php echo strtoupper($fetch_orders['method']); ?></td>
            <td>
                <span class="<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'status-pending' : 'status-completed'; ?>">
                    <?php echo $fetch_orders['payment_status']; ?>
                </span>
            </td>
            <td>
                <?php if($fetch_orders['payment_status'] == 'pending'): ?>
                    <a href="payment_confirm.php?update_payment=<?php echo $fetch_orders['id']; ?>" class="btn-confirm" onclick="return confirm('Thibitisha kuwa malipo yamepokelewa?')">Thibitisha</a>
                <?php endif; ?>
                <a href="payment_confirm.php?delete_order=<?php echo $fetch_orders['id']; ?>" class="btn-delete" onclick="return confirm('Futa oda hii?')">Futa</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' style='text-align:center;'>Hakuna oda iliyopatikana.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>