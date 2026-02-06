<?php 
include 'header.php'; 
include 'include/db.php';

// Logic ya kuhifadhi ujumbe kwenye database
if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    // Hakikisha una table inayoitwa 'messages' kwenye database yako
    $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message_status[] = 'Ujumbe huu ulishatumwa tayari!';
    }else{
        mysqli_query($conn, "INSERT INTO `messages`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message_status[] = 'Ujumbe wako umetumwa kikamilifu!';
    }
}
?>

<style>
/* CSS YA NDANI KWA AJILI YA CONTACT PAGE */
.contact {
    padding: 5rem 9%;
    background: white;
}

.contact .heading {
    text-align: center;
    margin-bottom: 3rem;
    font-size: 3rem;
    color: black;
    text-transform: uppercase;
}

.contact .row {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    align-items: center;
}

.contact .row .image {
    flex: 1 1 40rem;
}

.contact .row .image img {
    width: 100%;
    border-radius: 1rem;
}

.contact .row form {
    flex: 1 1 40rem;
    padding: 3rem;
    background: #fff;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
    border-radius: .5rem;
    border: 0.1rem solid #2c3e50;
}

.contact .row form h3 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
    text-transform: capitalize;
}

.contact .row form .box {
    margin: 1rem 0;
    width: 100%;
    background: orange;
    padding: 1.5rem;
    font-size: 1.6rem;
    color: #2c3e50;
    border-radius: .5rem;
    border: none;
}

.contact .row form textarea {
    height: 15rem;
    resize: none;
}

.status-msg {
    margin: 10px 0;
    padding: 10px;
    background: #e67e22;
    color: #fff;
    border-radius: 5px;
    text-align: center;
    font-size: 1.4rem;
}
</style>

<section class="contact">

    <h1 class="heading">Wasiliana Nasi</h1>

    <div class="row">
        <div class="image">
            <img src="./assets/images/wasilian.png" width="100px" height="100px" alt="Wasiliana Nasi">
        </div>

        <form action="" method="post">
            <h3>Tuandikie Ujumbe</h3>
            <?php
            if(isset($message_status)){
                foreach($message_status as $msg){
                    echo '<div class="status-msg">'.$msg.'</div>';
                }
            }
            ?>
            <input type="text" name="name" placeholder="Jina lako kamili" class="box" required>
            <input type="email" name="email" placeholder="Barua pepe (Email)" class="box" required>
            <input type="number" name="number" placeholder="Namba ya simu" class="box" required>
            <textarea name="message" class="box" placeholder="Andika ujumbe wako hapa..." cols="30" rows="10" required></textarea>
            <input type="submit" value="Tuma Ujumbe" name="send" class="btn">
        </form>
    </div>

</section>

<?php include 'footer.php'; ?>