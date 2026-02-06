<?php
// 1. Anza session ili uweze kuifikia
session_start();

// 2. Ondoa data zote zilizohifadhiwa kwenye session (user_id, role, nk)
session_unset();

// 3. Haribu session kabisa kutoka kwenye server
session_destroy();

// 4. Mrudishe mtumiaji kwenye ukurasa wa Login au Home
header("Location: login.php");
exit();
?>