<?php
session_start();
include 'include/db.php';
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Sera ya Faragha | Vyombo Store</title>
    <link rel="stylesheet" href="./style/index.css">
    <style>
        .policy-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            line-height: 1.6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .policy-container h1 { color: #2c3e50; border-bottom: 2px solid #e67e22; padding-bottom: 10px; }
        .policy-container h2 { color: #e67e22; margin-top: 25px; }
        .policy-container p { color: #555; margin-bottom: 15px; }
    </style>
</head>
<body>

<header>
    <div class="top-nav" style="background: #2c3e50; padding: 10px 5%;">
        <a href="index.php" style="color: white; text-decoration: none;"><i class="fa fa-arrow-left"></i> Rudi Nyumbani</a>
    </div>
</header>

<div class="policy-container">
    <h1>Sera ya Faragha </h1>
    <p>Karibu Vyombo Store. Tunathamini faragha yako na tumejitolea kulinda taarifa zako binafsi.</p>

    <h2>1. Taarifa Tunazokusanya</h2>
    <p>Tunakusanya taarifa unazotupa wakati unajisajili kwenye mfumo wetu, ikiwa ni pamoja na:</p>
    <ul>
        <li>Jina lako kamili</li>
        <li>Barua pepe (Email)</li>
        <li>Namba ya simu (wakati wa malipo)</li>
        <li>Anwani ya makazi kwa ajili ya usafirishaji</li>
    </ul>

    <h2>2. Jinsi Tunavyotumia Taarifa Zako</h2>
    <p>Taarifa hizi zinatumika kwa ajili ya:</p>
    <ul>
        <li>Kushughulikia oda zako na malipo.</li>
        <li>Kuwasiliana nawe kuhusu hali ya oda yako.</li>
        <li>Kuboresha huduma zetu za kibiashara nchini Tanzania.</li>
    </ul>

    <h2>3. Ulinzi wa Data</h2>
    <p>Tunatumia mbinu za usalama  kuhakikisha kuwa taarifa zako hazipotei au kufikiwa na watu wasiohusika. Hatuziuzi taarifa zako kwa makampuni ya nje.</p>

    <h2>4. Malipo ya Simu na Kadi</h2>
    <p>Malipo yote yanayofanyika kupitia Mobile Money au Kadi yanachakatwa kupitia njia salama . Hatuhifadhi namba zako za siri za kadi au simu kwenye database yetu.</p>

    <h2>5. Mawasiliano</h2>
    <p>Ikiwa una maswali kuhusu sera hii, wasiliana nasi kupitia <strong>info@vyombobora.co.tz</strong></p>
</div>

<footer style="text-align: center; padding: 20px; color: #888;">
    &copy; <?php echo date('Y'); ?> Vyombo Store Tanzania.
</footer>

</body>
</html>