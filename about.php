<?php 
session_start();
include 'include/db.php'; 
?>

<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuhusu Sisi | Vyombo Bora Store</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .about {
            padding: 5rem 10%;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 3rem;
        }
        .about-image {
            flex: 1 1 40rem;
        }
        .about-image img {
            width: 100%;
            border-radius: 1rem;
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
        }
        .about-content {
            flex: 1 1 40rem;
        }
        .about-content h3 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 1.5rem;
        }
        .about-content p {
            font-size: 1.1rem;
            color: #666;
            line-height: 2;
            margin-bottom: 2rem;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
            gap: 2rem;
            padding: 5rem 10%;
            background: #eee;
        }
        .feature-box {
            text-align: center;
            padding: 2rem;
            background: var(--white);
            border-radius: .5rem;
        }
        .feature-box i {
            font-size: 3rem;
            color: var(--orange);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<?php include 'header.php'; //Ikiwa una file tofauti la header, kama huna tumia kodi ya header tulizoziona mwanzo ?>


<section class="about">
    <div class="about-image">
        <img src="./assets/images/BANN.jpg" alt="Duka Letu la Vyombo">
    </div>

    <div class="about-content">
        <h3>Kuhusu Vyombo Bora Store</h3>
        <p>Sisi ni duka namba moja nchini Tanzania linalojihusisha na uuzaji wa vyombo vya kisasa vya ndani. Tangu kuanzishwa kwetu mwaka 2022, tumekuwa tukitoa suluhisho bora kwa mama wa nyumbani na wapishi wanaotafuta ubora na urembo jikoni.</p>
        <p>Lengo letu ni kuhakikisha kila nyumba ya Mtanzania inapata vyombo imara kwa bei nafuu kupitia mfumo wetu rahisi wa manunuzi mtandaoni.</p>
        <a href="products.php" class="btn">Anza Manunuzi</a>
    </div>
</section>

<section class="features">
    <div class="feature-box">
        <i class="fas fa-shipping-fast"></i>
        <h3>Usafirishaji wa Haraka</h3>
        <p>Tunatuma vyombo mikoani kote Tanzania ndani ya masaa 24-48.</p>
    </div>
    <div class="feature-box">
        <i class="fas fa-shield-alt"></i>
        <h3>Ubora Uliothibitishwa</h3>
        <p>Bidhaa zetu zote ni imara na zimepita vipimo vya ubora.</p>
    </div>
    <div class="feature-box">
        <i class="fas fa-headset"></i>
        <h3>Huduma kwa Wateja</h3>
        <p>Tupo tayari kukusaidia saa 24 kupitia simu na WhatsApp.</p>
    </div>
</section>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Target Market</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .target-market {
      padding: 50px 20px;
      background-color: #f9f9f9;
      text-align: center;
    }

    .target-market h2 {
      font-size: 32px;
      margin-bottom: 10px;
      color: #333;
    }

    .target-market .intro {
      font-size: 16px;
      margin-bottom: 40px;
      color: #555;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .market-container {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .market-box {
      background: #ffffff;
      padding: 25px;
      width: 300px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .market-box h3 {
      color: #8B5E3C; /* kahawia */
      margin-bottom: 10px;
    }

    .market-box p {
      font-size: 14px;
      color: #444;
      line-height: 1.6;
    }
  </style>
</head>
<body>

  <section class="target-market">
    <h2>Target Market Yetu</h2>
    <p class="intro">
      Tunalenga kuwahudumia wateja wanaohitaji vyombo bora vya jikoni kwa matumizi
      ya biashara na matumizi ya nyumbani, ikiwemo vikombe, blender na vifaa vingine.
    </p>

    <div class="market-container">

      <div class="market-box">
        <h3>Wafanyabiashara</h3>
        <p>
          Tunawalenga wafanyabiashara wanaouza au kutumia vyombo vya jikoni
          kama vikombe na blender kwa biashara zao, kwa bidhaa zenye ubora
          na bei rafiki.
        </p>
      </div>

      <div class="market-box">
        <h3>Wapishi wa Nyumbani</h3>
        <p>
          Kwa wapishi wa nyumbani, tunatoa vyombo imara na rahisi kutumia
          vinavyorahisisha maandalizi ya chakula cha kila siku.
        </p>
      </div>

      <div class="market-box">
        <h3>Mahoteli & Migahawa</h3>
        <p>
          Tunahudumia mahoteli na migahawa kwa kutoa vifaa vya jikoni vya
          kitaalamu vinavyodumu muda mrefu na kuhimili matumizi ya mara kwa mara.
        </p>
      </div>

    </div>
  </section>

</body>
</html>
<?php include 'footer.php'; ?>

</body>
</html>
