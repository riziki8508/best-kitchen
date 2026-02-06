<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function ya kulinda kurasa za Mteja (Customer)
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Function ya kulinda kurasa za Admin
function checkAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        // Ikiwa siyo admin, mrudishe login au index
        header("Location: ../login.php"); 
        exit();
    }
}
?>