<?php include 'db.php'; ?>

<?php

    // u ovom file-u se nalazi kod koji proverava da li je user ulogovan.
    // ovaj file treba inkludovati na pocetku svih skripti (strana) za
    // koje zelimo da budu dostupne samo ulogovanim korisnicima.
    // u primeru je to uradjeno samo na ads.php strani
    session_start();

    // izvlacimo email logovanog usera iz sesije.
    // ova $_SESSION varijabla nam je uvek dostupna
    // kada je izvsen session_start()
    $idFromSession = $_SESSION['user_id'];

    $getUserQuery = "SELECT * FROM users WHERE  id='{$idFromSession}'";
    $statement = $conn->prepare($getUserQuery);
    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $user = $statement->fetch();

    if (empty($user)) {
        // user nije ulogovan, vracamo ga na login stranu
        header('Location: login.php');
    }
?>