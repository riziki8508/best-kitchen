<?php
include '../include/db.php';
include '../include/auth.php';
checkAdmin();

// Logic ya kubadilisha hali ya malipo kuwa 'Completed' au 'Pending'
if(isset($_GET['status']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $status = $_GET['status'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$status' WHERE id = '$id'") or die('Query Imefeli');
    header('location:manage_payment.php');
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Usimamizi wa Malipo | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --orange: #e67e22; --dark: #2c3e50; --white: #fff; --bg: #f4f4f4; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); margin: 0; padding: 20px; }
        
        .container { max-width: 1200px; margin: 0 auto; }
        .header-box { background: var(--dark); color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .header-box a { color: white; text-decoration: none; font-weight: bold; border: 1px solid white; padding: 5px 15px; border-radius: 5px; }

        .payment-table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .payment-table th, .payment-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        .payment-table th { background: var(--orange); color: white; text-transform: uppercase; font-size: 14px; }
        
        .status { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .pending { background: #ffeaa7; color: #d35400; }
        .completed { background: #55efc4; color: #00b894; }

        .action-btns a { text-decoration: none; padding: 5px 10px; border-radius: 5px; font-size: 13px; color: white; margin-right: 5px; }
        .btn-approve { background: #27ae60; }
        .btn-wait { background: #f39c12; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-box">
        <h2><i class="fas fa-file-invoice-dollar"></i> Usimamizi wa Malipo</h2>
        <a href="index.php">Rudi Dashboard</a>
    </div>

    <table class="payment-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mteja</th>
                <th>Namba ya Simu</th>
                <th>Kiasi (Tsh)</th>
                <th>Njia ya Malipo</th>
                <th>Hali</th>
                <th>Badili Hali</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_payments = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY id DESC") or die('Query imefeli');
            if(mysqli_num_rows($select_payments) > 0){
                while($row = mysqli_fetch_assoc($select_payments)){
            ?>
            <tr>
                <td>#<?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['number']; ?></td>
                <td><strong><?php echo number_format($row['total_price']); ?>/-</strong></td>
                <td><i class="fas fa-mobile-alt"></i> <?php echo strtoupper($row['method']); ?></td>
                <td>
                    <span class="status <?php echo $row['payment_status']; ?>">
                        <?php echo ucfirst($row['payment_status']); ?>
                    </span>
                </td>
                <td class="action-btns">
                    <?php if($row['payment_status'] == 'pending'): ?>
                        <a href="manage_payment.php?status=completed&id=<?php echo $row['id']; ?>" class="btn-approve" onclick="return confirm('Thibitisha malipo haya?')">Thibitisha</a>
                    <?php else: ?>
                        <a href="manage_payment.php?status=pending&id=<?php echo $row['id']; ?>" class="btn-wait">Rudisha Pending</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center; padding:20px;'>Bado hakuna malipo yaliyofanyika.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>