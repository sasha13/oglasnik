
<?php include 'session.php'; ?>
<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Ads</h1>

					<?php
                        // pripremamo upit
                        $getAllAdsQuery = "SELECT * FROM ads ORDER BY id DESC";
                        $statement = $conn->prepare($getAllAdsQuery);

                        // izvrsavamo upit
                        $statement->execute();

                        // zelimo da se rezultat vrati kao asocijativni niz.
                        // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                        $statement->setFetchMode(PDO::FETCH_ASSOC);

                        // punimo promenjivu sa rezultatom upita
                        $allAds = $statement->fetchAll();

                        // iteriramo po nizu oglasa
                        foreach ($allAds as $ad) {
                    ?>

                        <!-- za svaki oglas na strani prikazujemo title i text -->
                        <!-- obe stvari su klikabilne i vode na stranu pojedinacnog oglasa -->
                        <!-- link je kreiran uz pomoc query parametra (?id=) -->
                        <a href="ad.php?id=<?php echo $ad['id'] ?>">
                            <h3><?php echo $ad['title'] ?></h3>
                            <p><?php echo $ad['text'] ?></p>
                        </a>

                        <!-- edit i delete link pravimo sa 'id' parametrom koji jednoznacno odredjuje oglas -->
                        <!-- taj parametar u url-u mozemo procitati iz $_GET promenjive kada 'sletimo' na stranu iz linka -->
                        <a href="ad-edit.php?id=<?php echo $ad['id'] ?>">Edit</a>
                        <a href="?delete_id=<?php echo $ad['id'] ?>">Delete</a>

                        <br />
                        <br />

                    <?php } ?>

                    <?php
                        // zbog ovog isset() uslova ovaj deo koda ce se izvrsiti samo kada se klikne na 'Delete' dugme.
                        if (isset($_GET['delete_id'])) {
                            $adToBeDeletedId = $_GET['delete_id'];

                            $deleteSingleQuery = "DELETE FROM ads WHERE id = $adToBeDeletedId";
                            $statement = $conn->prepare($deleteSingleQuery);

                            $statement->execute();

                            header('Location: ads.php');
                        }
                    ?>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>