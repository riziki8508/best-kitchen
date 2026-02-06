<?php
session_start();
include '../include/db.php';

// USALAMA: Hakikisha aliyeingia ni Admin [cite: 17, 30]
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:../login.php');
    exit();
}

// RIPOTI: Pata jumla ya oda na mapato 
$total_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
$total_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) as total FROM orders"))['total'];
$total_products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Vyombo Store</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #2c3e50; color: white; padding: 20px; }
        .sidebar a { display: block; color: white; padding: 10px; margin: 10px 0; border-radius: 5px; }
        .sidebar a:hover { background: #e67e22; }
        .main-content { flex: 1; padding: 30px; background: #f4f4f4; }
        .stats-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 10px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card h3 { color: #e67e22; font-size: 2rem; }
        table { width: 100%; background: white; border-collapse: collapse; margin-top: 20px; }
        table th, table td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        table th { background: #2c3e50; color: white; }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <hr>
        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a href="manage_products.php"><i class="fa fa-box"></i> Manage Products</a>
        <a href="manage_users.php"><i class="fa fa-users"></i> Manage Users</a>
          <a href="manage_payments.php"><i class="fa fa-eye"></i> View Site</a>
        <a href="payment_confirm.php"><i class="fa fa-money-bill-wave"></i> Confirm Payment</a>
        <a href="../index.php"><i class="fa fa-eye"></i> View Site</a>
       
        <a href="../logout.php" style="background: #c0392b;"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <div class="main-content">
        <h1>Dashboard Summary</h1>
        
        <div class="stats-cards">
            <div class="card">
                <p>Total Revenue</p>
                <h3>Tsh <?php echo number_format($total_revenue); ?>/-</h3>
            </div>
            <div class="card">
                <p>Total Orders</p>
                <h3><?php echo $total_orders; ?></h3>
            </div>
            <div class="card">
                <p>Total Products</p>
                <h3><?php echo $total_products; ?></h3>
            </div>
        </div>

        <h2>Recent Orders (Order Management)</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC LIMIT 10");
                while($row = mysqli_fetch_assoc($orders)) {
                    echo "<tr>
                            <td>#{$row['id']}</td>
                            <td>User #{$row['user_id']}</td>
                            <td>Tsh ".number_format($row['total_amount'])."</td>
                            <td style='color: green; font-weight: bold;'>{$row['payment_status']}</td>
                            <td>{$row['order_date']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>