<?php include 'db.php'; ?>

<?php
    // uvek kada baratamo sa sesijom moramo da krenemo sa session_start()
    session_start();
    //    inicijalizujemo varijablu u kojoj cemo cuvati eventualne
    //    greske pri login-u (email ili pass nije dobar) da bi smo ih kasnije
    //    prikazali korisniku
    $error = '';

    // ovaj deo koda se izvrsava samo kada se klikne na 'Login' dugme
    // na login formi
    if (isset($_POST['submit'])) {

        // odmah proverimo da li je nesto ukucano u email i password polja
        // i ako nije punimo varijablu error koju prikazujemo ispod forme
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $error = "Email or Password is invalid";
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // pokusamo da dovucemo user-a iz baze sa podacima koji su uneseni u formu
            $getUserQuery = "SELECT * FROM users WHERE password='{$password}' AND email='{$email}'";
            $statement = $conn->prepare($getUserQuery);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $user = $statement->fetch();

            // ukoliko postoji user sa unetim podacima, $user varijabla nece biti prazna.
            // u tom slucaju upisujemo user_id u sesiju (logujemo korisnika) i redirektujemo
            // ga na prvu stranu za logovane korisnike (ja sam stavio ads.php ali moze biti bilo koja strana)
            if (!empty($user)) {
                // Initializing Session
                $_SESSION['user_id'] = $user['id'];
                // Redirecting To Other Page
                header("location: ads.php");
            // ukoliko ne postoji user sa unetim podacima (neuspesno logovanje)
            // set-ujemo gresku koju prikazujemo na formi
            } else {
                $error = "Email or Password is invalid";
            }
        }
    }
?>

<?php include 'header.php'; ?>
<section class="site-content">
    <div class="site-columns">
        <main class="site-main">
            <div class="container">
                <div id="login">
                    <h2>Login Form</h2>
                    <form action="" method="post">
                        <label>email :</label>
                        <input id="name" name="email" placeholder="email" type="text">
                        <label>Password :</label>
                        <input id="password" name="password" type="password">
                        <input name="submit" type="submit" value="Login">
                        <span><?php echo $error; ?></span>
                    </form>
                </div>

            </div>
        </main>
    </div>
</section>
<?php include 'footer.php'; ?>
