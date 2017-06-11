<?php include 'db.php'; ?>

<!-- ova skripta se izvrsava kada se dolazi na stranu pojedinacnog oglasa
    i kada se klikne na 'delete' link na istoj strani.
    Zbog toga je neophodno imati 2 uslova (If-a)
    -->
<?php
    if (isset($_GET['id'])) {
        $adId = $_GET['id'];

        // query koji dovlaci oglas sa dodatnim podacima iz povezanih tabela
        $getSingleAdQuery = "SELECT ads.id, ads.title, ads.text, ads.created_at, ads.expires_on,
        categories.name AS category_name, users.id AS user_id,
        profiles.first_name, profiles.last_name, profiles.city, profiles.phone FROM ads
        LEFT JOIN categories ON categories.id = ads.category_id
        LEFT JOIN users ON users.id = ads.user_id
        LEFT JOIN profiles ON profiles.user_id = users.id WHERE ads.id = $adId";

        $statement = $conn->prepare($getSingleAdQuery);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        // razlika izmedju fetch() i fetchAll() je u tom sto
        // fetch dovlaci jedan rezultat a fetchAll() niz rezultata
        $singleAd = $statement->fetch();
    }


    // zbog ovog isset() uslova ovaj deo koda ce se izvrsiti samo kada se klikne na 'Delete' dugme.
    // zasto? sta mi ovde u stvari proveravamo?
    // pitamo - da li u globalnoj promenjivoj $_GET, koja je niz, postoji vrednost sa kljucem 'delete_id'?
    // posto se ta promenjiva u nasem kodu postavlja jedino kada se pravi delete link, mozemo biti sigurni
    // da ce se jedino klikom na 'delete' link ovaj deo koda izvrsiti.
    // nakon uspesnog brisanja , redirektujemo korisnika na stranu svih oglasa
    if (isset($_GET['delete_id'])) {
        $adToBeDeletedId = $_GET['delete_id'];

        $deleteSingleQuery = "DELETE FROM ads WHERE id = $adToBeDeletedId";
        $statement = $conn->prepare($deleteSingleQuery);
        $statement->execute();

        header('Location: ads.php');
    }

?>
<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Ad</h1>
                    <!--  -->
                    <h2><?php echo $singleAd['title'] ?></h2>
                    <p>Kategorija: <?php echo $singleAd['category_name'] ?></p>
                    <p><?php echo $singleAd['text'] ?></p>
                    <p>Grad: <?php echo $singleAd['city'] ?></p>
                    <ul>Kontakt:
                        <li><?php echo $singleAd['first_name'] ?> <?php echo $singleAd['last_name'] ?></li>
                        <li><?php echo $singleAd['phone'] ?></li>
                    </ul>
                    <p>Postavljen: <?php echo date_format(date_create($singleAd['created_at']), DATE_RSS) ?></p>
                    <p>Istice: <?php echo date_format(date_create($singleAd['expires_on']), DATE_RSS) ?></p>

                    <!-- edit i delete link pravimo sa 'id' parametrom koji jednoznacno odredjuje oglas -->
                    <!-- taj parametar u url-u mozemo procitati iz $_GET promenjive kada 'sletimo' na stranu iz linka -->
                    <a href="ad-edit.php?id=<?php echo $singleAd['id'] ?>">Edit</a>
                    <a href="?delete_id=<?php echo $singleAd['id'] ?>">Delete</a>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
