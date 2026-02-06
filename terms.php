<?php
session_start();
include 'include/db.php';
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Sheria na Masharti | Vyombo Store</title>
    <link rel="stylesheet" href="./style/index.css">
    <style>
        .terms-container {
            max-width: 850px;
            margin: 40px auto;
            background: #fff;
            padding: 40px;
            border-left: 5px solid #e67e22;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .terms-container h1 { color: #2c3e50; font-size: 2rem; margin-bottom: 20px; }
        .terms-container h2 { color: #e67e22; font-size: 1.3rem; margin-top: 25px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .terms-container p, .terms-container li { color: #444; line-height: 1.8; margin-bottom: 10px; }
        .back-btn { display: inline-block; margin-bottom: 20px; color: #e67e22; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="terms-container">
    <a href="index.php" class="back-btn">← Rudi Nyumbani</a>
    <h1>Sheria na Masharti (Terms & Conditions)</h1>
    <p>Karibu katika duka la Vyombo Store. Unapotumia tovuti yetu kufanya manunuzi, unakubaliana na masharti yafuatayo:</p>

    <h2>1. Usajili wa Akaunti</h2>
    <p>Mteja anapaswa kutoa taarifa za kweli wakati wa kujisajili. Ni jukumu la mteja kulinda nenosiri (password) la akaunti yake ili kuzuia matumizi yasiyoruhusiwa.</p>

    <h2>2. Maelezo ya Bidhaa na Bei</h2>
    <p>Tunajitahidi kuhakikisha picha na bei za vyombo ni sahihi. Hata hivyo, bei zinaweza kubadilika bila taarifa kulingana na mabadiliko ya soko nchini Tanzania.</p>

    <h2>3. Malipo na Usalama</h2>
    <ul>
        <li>Malipo yote lazima yakamilike kabla ya chombo kufika kwa mteja (Pre-payment) kupitia Mobile Money au Kadi.</li>
        <li>Muamala ukishathibitishwa, oda itaanza kufanyiwa kazi ndani ya masaa 24.</li>
    </ul>

    <h2>4. Sera ya Kurudisha Bidhaa (Refund Policy)</h2>
    <p>Chombo kinaweza kurudishwa au kubadilishwa ndani ya siku 2 tu baada ya kupokelewa, ikiwa tu kitakuwa na hitilafu ya kiwandani (kama kimepasuka au hakifanyi kazi) na hakijatumiwa.</p>

    <h2>5. Usafirishaji (Delivery)</h2>
    <p>Tunafanya usafirishaji mikoani kote Tanzania kupitia mabasi au kampuni za usafirishaji. Gharama za usafiri ni juu ya mteja isipokuwa kukiwa na ofa maalum.</p>

    <h2>6. Mabadiliko ya Masharti</h2>
    <p>Vyombo Store ina haki ya kubadilisha masharti haya wakati wowote ili kuboresha huduma zetu na kufuata sheria za biashara za mtandao nchini.</p>
</div>

<footer style="text-align: center; padding: 30px; color: #777;">
    &copy; <?php echo date('Y'); ?> Vyombo Store | Kariakoo, Dar es Salaam.
</footer>

</body>
</html>