<link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <footer class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Link za Haraka</h3>
            <a href="index.php"> <i class="fas fa-arrow-right"></i> Nyumbani </a>
            <a href="products.php"> <i class="fas fa-arrow-right"></i> Bidhaa </a>
            <a href="about.php"> <i class="fas fa-arrow-right"></i> Kuhusu Sisi </a>
        </div>

        <div class="box">
            <h3>Msaada</h3>
            <a href="contact.php"> <i class="fas fa-arrow-right"></i> Wasiliana Nasi </a>
            <a href="privacy_policy.php"> <i class="fas fa-arrow-right"></i> Sera ya Faragha </a>
            <a href="terms.php"> <i class="fas fa-arrow-right"></i> Sheria na Masharti </a>
        </div>

        <div class="box">
            <h3>Mawasiliano</h3>
            <a href="#"> <i class="fas fa-phone"></i> +255 712 345 678 </a>
            <a href="#"> <i class="fas fa-envelope"></i> info@vyombobora.co.tz </a>
            <a href="#"> <i class="fas fa-map-marker-alt"></i> Kariakoo, Dar es Salaam </a>
        </div>
    </div>

    <div class="credit"> &copy; <?php echo date('Y'); ?> Imetengenezwa na <span>Vyombo Bora Team</span> | Haki zote zimehifadhiwa. </div>
</footer>

<script>
let navbar = document.querySelector('.navbar');
document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
}
</script>
</body>
</html>