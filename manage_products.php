<?php
session_start();
include '../include/db.php';

// Hakikisha ni Admin pekee
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:../login.php');
    exit();
}

// --- LOGIC YA KUONGEZA BIDHAA (ADD) ---
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $image = $_FILES['image']['name'];
    $target = "../assets/images/" . basename($image);

    $insert = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$desc', '$image')";
    if (mysqli_query($conn, $insert)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $msg = "Bidhaa imeongezwa kikamilifu!";
    }
}

// --- LOGIC YA KUFUTA BIDHAA (DELETE) ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:manage_products.php');
}

// --- LOGIC YA KUBADILI (UPDATE) - Hapa tunachukua data tu kwanza ---
$update_mode = false;
$u_id = $u_name = $u_price = $u_desc = "";
if (isset($_GET['edit'])) {
    $update_mode = true;
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    $data = mysqli_fetch_assoc($res);
    $u_id = $data['id']; $u_name = $data['name']; $u_price = $data['price']; $u_desc = $data['description'];
}

if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    mysqli_query($conn, "UPDATE products SET name='$name', price='$price', description='$desc' WHERE id=$id");
    header('location:manage_products.php');
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <title>Manage Products | Admin</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-container { background: white; padding: 20px; margin-bottom: 30px; border-radius: 8px; }
        .form-container input, .form-container textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .action-btns a { margin-right: 10px; padding: 5px 10px; border-radius: 3px; color: white; }
    </style>
</head>
<body>

<div style="display: flex;">
    <div style="width: 250px; background: #2c3e50; color: white; min-height: 100vh; padding: 20px;">
        <h2>Vyombo Admin</h2>
        <a href="index.php" style="color:white; display:block; margin: 20px 0;">Dashboard</a>
        <a href="manage_products.php" style="color:white; display:block;">Manage Products</a>
    </div>

    <div style="flex: 1; padding: 30px;">
        <h1>Usimamizi wa Bidhaa</h1>

        <div class="form-container">
            <h3><?php echo $update_mode ? "Badili Bidhaa" : "Ongeza Bidhaa Mpya"; ?></h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $u_id; ?>">
                <input type="text" name="name" placeholder="Jina la chombo" value="<?php echo $u_name; ?>" required>
                <input type="number" name="price" placeholder="Bei (Tsh)" value="<?php echo $u_price; ?>" required>
                <textarea name="description" placeholder="Maelezo ya bidhaa"><?php echo $u_desc; ?></textarea>
                <?php if(!$update_mode): ?>
                    <input type="file" name="image" required>
                    <button type="submit" name="add_product" class="btn">Add product</button>
                <?php else: ?>
                    <button type="submit" name="update_product" class="btn" style="background:green;">Hifadhi Mabadiliko</button>
                    <a href="manage_products.php" class="btn" style="background:grey;">Cancel</a>
                <?php endif; ?>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = mysqli_query($conn, "SELECT * FROM products");
                while($row = mysqli_fetch_assoc($products)) {
                    echo "<tr>
                            <td><img src='../assets/images/{$row['image']}' width='50'></td>
                            <td>{$row['name']}</td>
                            <td>Tsh ".number_format($row['price'])."</td>
                            <td class='action-btns'>
                                <a href='manage_products.php?edit={$row['id']}' style='background: orange;'>Edit</a>
                                <a href='manage_products.php?delete={$row['id']}' style='background: red;' onclick='return confirm(\"Futa bidhaa hii?\")'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>