<?php
// Taarifa za kuunganisha database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tanzania_ecommerce"; // Hakikisha jina hili linafanana na database uliyotengeneza phpMyAdmin

// Fungua muunganisho (Create connection)
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Hakiki kama muunganisho umefanikiwa
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset iwe UTF-8 ili kusaidia herufi za Kiswahili na alama nyingine
mysqli_set_charset($conn, "utf8");
?>