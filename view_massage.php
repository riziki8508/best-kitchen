<?php
include '../include/auth.php'; // Inahakikisha ni Admin tu anaingia
include '../include/db.php';
checkAdmin();

// Logic ya kufuta ujumbe
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('query failed');
    header('location:view_messages.php');
}
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Ujumbe wa Wateja | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --orange: #e67e22;
            --dark: #2c3e50;
            --white: #fff;
            --light-bg: #f4f4f4;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            margin: 0; padding: 20px;
        }

        .admin-nav {
            background: var(--dark);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .admin-nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        .heading {
            text-align: center;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 2rem;
        }

        .message-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .message-box {
            background-color: var(--white);
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
            border: 1px solid var(--dark);
        }

        .message-box p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .message-box p span {
            color: var(--dark);
            font-weight: bold;
        }

        .delete-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .empty {
            text-align: center;
            padding: 2rem;
            background: white;
            font-size: 1.5rem;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="admin-nav">
    <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="manage_products.php">Bidhaa</a>
    <a href="view_messages.php" style="color: var(--orange);">Ujumbe</a>
    <a href="../logout.php">Logout</a>
</div>

<h1 class="heading">Ujumbe Kutoka kwa Wateja</h1>

<div class="message-container">

    <?php
    $select_message = mysqli_query($conn, "SELECT * FROM `messages` ORDER BY id DESC") or die('query failed');
    if(mysqli_num_rows($select_message) > 0){
        while($fetch_message = mysqli_fetch_assoc($select_message)){
    ?>
    <div class="message-box">
        <p> User ID : <span><?php echo $fetch_message['user_id']; ?></span> </p>
        <p> Jina : <span><?php echo $fetch_message['name']; ?></span> </p>
        <p> Simu : <span><?php echo $fetch_message['number']; ?></span> </p>
        <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
        <p> Ujumbe : <span><?php echo $fetch_message['message']; ?></span> </p>
        <a href="view_messages.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Futa ujumbe huu?');" class="delete-btn">Futa Ujumbe</a>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">Huna ujumbe wowote mpya!</p>';
    }
    ?>

</div>

</body>
</html>