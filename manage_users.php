<?php
session_start();
include '../include/db.php';

// USALAMA: Hakikisha ni Admin pekee anayeweza kuingia
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:../login.php');
    exit();
}

// LOGIC YA KUFUTA MTUMIAJI (DELETE USER)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Kuzuia Admin asijifute mwenyewe kwa bahati mbaya
    if ($id == $_SESSION['user_id']) {
        echo "<script>alert('Huwezi kufuta akaunti yako mwenyewe ukiwa ndani!'); window.location.href='manage_users.php';</script>";
    } else {
        mysqli_query($conn, "DELETE FROM users WHERE id = $id");
        header('location:manage_users.php');
    }
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Manage Users </title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #2c3e50; padding: 20px; color: white; }
        .sidebar a { display: block; color: white; padding: 10px; margin: 5px 0; text-decoration: none; }
        .sidebar a:hover { background: #e67e22; border-radius: 5px; }
        
        .content { flex: 1; padding: 30px; background: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 15px; border: 1px solid #ddd; text-align: left; }
        th { background: #2c3e50; color: white; }
        .role-badge { padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; font-weight: bold; }
        .role-admin { background: #e74c3c; color: white; }
        .role-user { background: #2ecc71; color: white; }
        .delete-btn { color: #c0392b; font-size: 1.2rem; cursor: pointer; }
    </style>
</head>
<body>

<div class="admin-layout">
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <hr>
        <a href="index.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="manage_products.php"><i class="fa fa-box"></i> Manage Products</a>
        <a href="manage_users.php"><i class="fa fa-users"></i> Manage Users</a>
        <a href="../logout.php" style="margin-top: 20px; background: #c0392b;"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h1>Usimamizi wa Watumiaji</h1>
        <p>Hapa unaweza kuona na kusimamia wateja pamoja na admin wengine.</p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registration date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users_query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
                while($user = mysqli_fetch_assoc($users_query)) {
                    $role_class = ($user['role'] == 'admin') ? 'role-admin' : 'role-user';
                ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['fullname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><span class="role-badge <?php echo $role_class; ?>"><?php echo strtoupper($user['role']); ?></span></td>
                    <td><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
                    <td>
                        <a href="manage_users.php?delete=<?php echo $user['id']; ?>" 
                 class="delete-btn" 
                 onclick="return confirm('Do you want to delete thids user?')">
                 <i class="fa fa-user-times"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>